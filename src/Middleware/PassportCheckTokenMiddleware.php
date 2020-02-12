<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 04/09/19
 * Time: 9:39
 */

namespace Aminin\PassportClient\Middleware;


use Aminin\PassportClient\Exceptions\InvalidRequestException;
use Aminin\PassportClient\PassportClient;

class PassportCheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$scopes
     * @return mixed
     */
    public function handle($request, \Closure $next, ...$scopes)
    {
        $authorization_header = $request->header('Authorization');
        if (! $authorization_header)
            throw new InvalidRequestException(422, "Authorization header is missing.");

        $access_token = explode(" ", $authorization_header)[1];

        $passport_client = new PassportClient();
        $scopes_string = implode(",", $scopes);

        $passport_client->checkToken($access_token, $scopes_string);
        
        return $next($request);
    }
}
