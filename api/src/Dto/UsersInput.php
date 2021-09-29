<?php
namespace App\Dto;

final class UsersInput {
    /**
     * @var string|null
     */
    public $name;
    /**
     * @var string|null
     */
    public $email;
    /**
     * @var string|null
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