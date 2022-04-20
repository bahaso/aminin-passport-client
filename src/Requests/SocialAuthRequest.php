<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:43
 */

namespace Aminin\PassportClient\Requests;


use Aminin\PassportClient\Requests\Contracts\PassportRequest;

class SocialAuthRequest implements PassportRequest
{

    public function __construct(
        public string $client_id = "",
        public string $client_secret = "",
        public string $access_token = "",
        public string $grant_type = "",
        public string $scope = ""
    ) {}

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function getClientSecret()
    {
        return $this->client_secret;
    }

    public function getGrantType()
    {
        return $this->grant_type;
    }
    
    public function getScope()
    {
        return $this->scope;
    }
}
