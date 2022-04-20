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
    public function __construct(
        protected $id,
        protected $name,
        protected $email,
        protected $calling_code,
        protected $phone_number
    ) {}

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
