<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:37
 */

namespace Aminin\PassportClient\Responses;


class Response
{
    public $code;
    public $success;
    public $message;
    public $data;

    public function __construct($code = 200, $success = true, $message = 'success', $data = [])
    {
        $this->code = $code;
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    public function setCode($code)
    {
        return $this->code = $code;
    }

    public function setSuccess($success)
    {
        return $this->success = $success;
    }

    public function setMessage($message)
    {
        return $this->message = $message;
    }

    public function setData($data)
    {
        return $this->data = $data;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }
}
