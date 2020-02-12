<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 18/09/19
 * Time: 10:16
 */

namespace Aminin\PassportClient\Entities;


use Aminin\PassportClient\Entities\Contracts\UserInterface;
use Illuminate\Contracts\Support\Arrayable;

class User implements UserInterface, Arrayable
{
    protected $id;
    protected $name;
    protected $email;
    protected $calling_code;
    protected $phone_number;

    public function __construct($id, $name, $email, $calling_code, $phone_number)
    {
        $this->name = $name;
        $this->id = $id;
        $this->email = $email;
        $this->calling_code = $calling_code;
        $this->phone_number = $phone_number;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'calling_code' => $this->calling_code,
            'phone_number' => $this->phone_number
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCallingCode()
    {
        return $this->calling_code;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
}
