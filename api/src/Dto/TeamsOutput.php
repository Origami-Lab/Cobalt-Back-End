<?php
namespace App\Dto;

final class TeamsOutput {
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var Array|null
     */
    public $users2teams;
    /**
     * @var Array|null
     */
    public $users;
}