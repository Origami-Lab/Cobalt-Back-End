<?php
namespace App\Dto;

final class UsersInput {
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string|null
     */
    public $avatar;
    /**
     * @var Array|null
     */
    public $roles;
}