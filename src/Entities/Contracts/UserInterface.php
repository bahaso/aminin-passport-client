<?php
/**
 * Created by PhpStorm.
 * User: bahasolaptop2
 * Date: 18/09/19
 * Time: 10:15
 */

namespace Aminin\PassportClient\Entities\Contracts;


interface UserInterface
{
    public function getId();
    public function getName();
    public function getEmail();
    public function getPhoneNumber();
}
