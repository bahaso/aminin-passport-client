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

    public function __construct(
        public string $grant_type = "",
        public string $client_id = "",
        public string $client_secret = "",
        public string $otp_code = "",
        public string $state = "",
        public string $otp = ""
    ) {}

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
