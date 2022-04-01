<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $name;
    public $email;
    public $role;
    public $token;
}