<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 30/07/19
 * Time: 15:07
 */

namespace Aminin\PassportClient;


use Aminin\PassportClient\Entities\User;
use Aminin\PassportClient\Exceptions\InvalidGrantTypeException;
use Aminin\PassportClient\Exceptions\InvalidRequestException;
use Aminin\PassportClient\Exceptions\ServerResponseException;
use Aminin\PassportClient\Requests\Contracts\PassportRequest;
use Aminin\PassportClient\Requests\LoginRequest;
use Aminin\PassportClient\Requests\RegisterRequest;
use Aminin\PassportClient\Requests\SignInRequest;
use Aminin\PassportClient\Requests\SignUpRequest;
use Aminin\PassportClient\Requests\SocialAuthRequest;
use Aminin\PassportClient\Requests\ValidateOTPRequest;
use Aminin\PassportClient\Responses\GetUserResponse;
use Aminin\PassportClient\Responses\Response;
use Aminin\PassportClient\Responses\SignInResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PassportClient
{
    const GRANT_TYPE_PASSWORD = "password";
    const GRANT_TYPE_SOCIAL = "social";
    const GRANT_TYPE_CLIENT_CREDENTIALS = "client_credentials";
    const GRANT_TYPE_AUTH_OTP_CODE = "authorization_otp_code";
    const FACEBOOK_PROVIDER = "facebook";
    const GOOGLE_PROVIDER = "google";

    private static $user = null;
    private static $access_token = '';

    protected function prepareHttpClient()
    {
        $client = Http::withoutVerifying()->acceptJson();

        return $client;
    }

    public function testConnection()
    {
        $url = config('passport.test_connection_url', 'https://passporization.dev.io/api/connection/test');

        $response = $this->httpPostRequest($url);

        if ($response->ok()) {
            return new Response($response->status(), true, "You are connected with Auth Server", $response->json());
        }
        else {
            throw new ServerResponseException(500, "Something wrong with Authorization Server");
        }
    }

    public function prepareSignInRequest($client_id, $client_secret, $username, $password, $grant_type, $scope)
    {
        return
            new SignInRequest(
                $client_id,
                $client_secret,
                $username,
                $password,
                $grant_type,
                $scope
            );
    }
    
    public function signIn(SignInRequest $request)
    {
        $url = config('passport.sign_in_url', '');
        $body = $this->prepareRequestBody($request);

        $response = $this->httpPostRequest($url, $body);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    private function handleAuthServerSignInResponse($response)
    {
        if ($response['code'] !== 200) {
            $this->handleAuthServerResponseException($response);
        }
        return new SignInResponse($response['code'], true, $response['message'], $response['result']);
    }

    public function prepareSignUpRequest(
        $client_id,
        $client_secret,
        $email,
        $password,
        $first_name,
        $last_name,
        $gender,
        $cell_phone_number,
        $country_id,
        $city_id,
        $birthday,
        $grant_type,
        $scope
    )
    {
        return new SignUpRequest(
                $client_id,
                $client_secret,
                $email,
                $password,
                $first_name,
                $last_name,
                $gender,
                $cell_phone_number,
                $country_id,
                $city_id,
                $birthday,
                $grant_type,
                $scope
        );
    }

    public function signUp(SignUpRequest $request)
    {
        $url = config('passport.sign_up_url', '');
        $body = $this->prepareRequestBody($request);

        $response = $this->httpPostRequest($url, $body);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    private function prepareRequestBody(PassportRequest $request)
    {
        if ($request->getGrantType() == self::GRANT_TYPE_PASSWORD || $request->getGrantType() == self::GRANT_TYPE_SOCIAL || $request->getGrantType() == self::GRANT_TYPE_AUTH_OTP_CODE) {
            return (array) $request;
        }
        else {
            throw new InvalidGrantTypeException(422, "Grant type " . $request->getGrantType() . " is not supported");
        }
    }

    private function handleAuthServerResponseException($response)
    {
        $errors = isset($response['errors']) ? $response['errors'] : [];
        throw new ServerResponseException($response['code'], $response['message'], $errors);
    }

    public function validateAccessToken($access_token = null)
    {
        if (! $access_token) $access_token = $this->getAccessTokenFromHeader();
        return $this->getUserFromToken($access_token);
    }

    public function getAccessTokenFromHeader()
    {
        $header = request()->header('Authorization');
        if (! $header) throw new InvalidRequestException(422, "Missing Authorization on header request");
        if (strpos("Bearer", $header) !== false) throw new InvalidRequestException(422, "Missing Bearer on header request");
        return explode(" ", $header)[1];
    }

    public function getUserFromToken($access_token)
    {
        $url = config('passport.sign_in_url', '');

        $response = $this->httpGetRequest(url: $url, access_token: $access_token);

        return $this->handleAuthServerGetUserResponse($response->json());
    }

    private function handleAuthServerGetUserResponse($response)
    {
        if ($response['code'] !== 200) {
            $this->handleAuthServerResponseException($response);
        }

        return new GetUserResponse($response['code'], true, $response['message'], $response['result']);
    }

    private function handleAuthServerCheckTokenResponse($access_token, $scope, $response)
    {
        if ($response['code'] !== 200) {
            $this->handleAuthServerResponseException($response);
        }

        $user = $response['result']['user'];
        self::$user = new User($user['_id'], $user['name'], $user['email'], $user['calling_code'], $user['phone_number']);

        Cache::put($access_token, self::$user, 600);
        Cache::put($access_token.'_scope', $scope, 600);

        return new GetUserResponse($response['code'], true, $response['message'], $response['result']['oauth']);
    }

    public function prepareSocialAuthRequest($client_id, $client_secret, $access_token, $grant_type, $scope)
    {
        return
            new SocialAuthRequest(
                $client_id,
                $client_secret,
                $access_token,
                $grant_type,
                $scope
            );
    }

    public function socialAuth(SocialAuthRequest $request, $provider)
    {
        $url = match ($provider) {
            self::FACEBOOK_PROVIDER => config('passport.facebook_auth_url', ''),
            self::GOOGLE_PROVIDER => config('passport.facebook_auth_url', ''),
            default => "notfound"
        };

        $body = $this->prepareRequestBody($request);

        $response = $this->httpPostRequest($url, $body);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    public function checkToken($access_token, $scope)
    {
        self::$access_token = $access_token;
        
        if (Cache::has($access_token) && Cache::has($access_token.'_scope')) {
            $array_saved_scopes = explode(',', Cache::get($access_token.'_scope'));

            $array_check_scopes = explode(',', $scope);

            foreach ($array_check_scopes as $scope) {
                if (! in_array($scope, $array_saved_scopes))
                    throw new ServerResponseException(401, 'you are not authorized');
            }

            self::$user = Cache::get($access_token);
            return new GetUserResponse(200, true, 'success', self::$user);
        }

        $url = config('passport.check_token_url', ''). '?scope=' . $scope;
        $response = $this->httpGetRequest(url: $url, access_token: $access_token);

        return $this->handleAuthServerCheckTokenResponse($access_token, $scope, $response->json());
    }

    public function register(RegisterRequest $request)
    {
        $url = config('passport.register_url', '');

        $response = $this->httpPostRequest($url, (array) $request);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    public function login(LoginRequest $request)
    {
        $url = config('passport.log_in_url', '');
        $response = $this->httpPostRequest($url, (array) $request);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    public function validateOTP(ValidateOTPRequest $request)
    {
        $url = config('passport.validate_otp_url', '');
        $body = $this->prepareRequestBody($request);

        $response = $this->httpPostRequest($url, $body);

        return $this->handleAuthServerSignInResponse($response->json());
    }

    /**
     * @return User
     */
    public static function user()
    {
        return self::$user;
    }

    private function httpGetRequest(string $url, array $data = [], string $access_token = null)
    {
        $http = $this->prepareHttpClient();

        if ($access_token)
            $http = $http->withToken($access_token);

        try {
            $response = $http->get($url, $data);
        }
        catch (\Exception $exception) {
            throw new ServerResponseException($exception->getCode(), $exception->getMessage());
        }

        return $response;
    }

    private function httpPostRequest(string $url, array $data = [], string $access_token = null)
    {
        $http = $this->prepareHttpClient();

        if ($access_token)
            $http = $http->withToken($access_token);

        try {
            $response = $http->post($url, $data);
        }
        catch (\Exception $exception) {
            throw new ServerResponseException($exception->getCode(), $exception->getMessage());
        }

        return $response;
    }
}
