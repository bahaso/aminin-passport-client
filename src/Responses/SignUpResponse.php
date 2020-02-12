<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 31/07/19
 * Time: 15:41
 */

namespace Aminin\PassportClient\Responses;


class SignUpResponse extends Response
{
    public function __construct($code = 200, $success = true, $message = 'success', $data = [])
    {
        parent::__construct($code, $success, $message, $data);
    }
}
