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
    public $email = "";
    public $password = "";
    public $firstname = "";
    public $lastname = "";
    public $gender = "";
    public $cellphonenumber = "";
    public $country_id = "";
    public $city_id = "";
    public $birthday = "";
    public $client_id = "";
    public $client_secret = "";
    public $grant_type = "";
    public $scope = "";

    public function __construct(
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
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->cell_phone_number = $cell_phone_number;
        $this->country_id = $country_id;
        $this->city_id = $city_id;
        $this->birthday = $birthday;
        $this->grant_type = $grant_type;
        $this->scope = $scope;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCellPhoneNumber()
    {
        return $this->cellphonenumber;
    }

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function getBirthDay()
    {
        return $this->birthday;
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
