<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:57
 */

namespace Aminin\PassportClient\Requests;


use Aminin\PassportClient\Requests\Contracts\PassportRequest;

class SignUpRequest implements PassportRequest
{
    public function __construct(
        public string $client_id = "",
        public string $client_secret = "",
        public string $email = "",
        public string $password = "",
        public string $firstname = "",
        public string $lastname = "",
        public string $gender = "",
        public string $cellphonenumber = "",
        public string $country_id = "",
        public string $city_id = "",
        public string $birthday = "",
        public string $grant_type = "",
        public string $scope = ""
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFirstName(): string
    {
        return $this->firstname;
    }

    public function getLastName(): string
    {
        return $this->lastname;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getCellPhoneNumber(): string
    {
        return $this->cellphonenumber;
    }

    public function getCountryId(): string
    {
        return $this->country_id;
    }

    public function getCityId(): string
    {
        return $this->city_id;
    }

    public function getBirthDay(): string
    {
        return $this->birthday;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    public function getGrantType(): string
    {
        return $this->grant_type;
    }

    public function getScope(): string
    {
        return $this->scope;
    }
}
