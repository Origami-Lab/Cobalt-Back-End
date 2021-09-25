<?php
namespace App\Dto;

final class UsersOutput {
    /**
     * @var int
     */
    public $userid;
    /**
     * @var string|null
     */
    public $name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string|null
     */
    public $avatar;
    /**
     * @var Array|null
     */
    public $roles;
    /**
     * @var string|null
     */
    public $lastActivity;
    /**
     * @var Array|null
     */
    public $users2teams;
    /**
     * @var Array|null
     */
    public $teams;
    /**
     * @var int
     */
    public $totalExperiments;
}