<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:57
 */

namespace Aminin\PassportClient\Requests;


use Aminin\PassportClient\Requests\Contracts\PassportRequest;

class ValidateOTPRequest implements PassportRequest
{
    public $grant_type = "";
    public $client_id = "";
    public $client_secret = "";
    public $otp_code = "";
    public $state = "";
    public $otp = "";

    public function __construct(
        $grant_type,
        $client_id,
        $client_secret,
        $otp_code,
        $state,
        $otp
    )
    {
        $this->grant_type = $grant_type;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->otp_code = $otp_code;
        $this->state = $state;
        $this->otp = $otp;
    }

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grant_type;
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
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->otp_code;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getOtp(): string
    {
        return $this->otp;
    }
}
