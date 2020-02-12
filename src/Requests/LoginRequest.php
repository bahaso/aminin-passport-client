<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:57
 */

namespace Aminin\PassportClient\Requests;


class LoginRequest
{
    public $provider = "";
    public $response_type = "";
    public $client_id = "";
    public $scope = "";
    public $phone_number = "";

    public function __construct(
        $provider,
        $response_type,
        $client_id,
        $scope,
        $phone_number
    )
    {
        $this->provider = $provider;
        $this->response_type = $response_type;
        $this->client_id = $client_id;
        $this->scope = $scope;
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->response_type;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }


}
