<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:57
 */

namespace Aminin\PassportClient\Requests;


class RegisterRequest
{
    public $provider = "";
    public $response_type = "";
    public $client_id = "";
    public $scope = "";
    public $name = "";
    public $email = "";
    public $phone_number = "";

    public function __construct(
        $provider,
        $response_type,
        $client_id,
        $scope,
        $name,
        $email,
        $phone_number
    )
    {
        $this->provider = $provider;
        $this->response_type = $response_type;
        $this->client_id = $client_id;
        $this->scope = $scope;
        $this->name = $name;
        $this->email = $email;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }


}
