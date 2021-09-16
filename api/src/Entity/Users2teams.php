<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping\UniqueConstraint;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users2teams
 *
 * @ORM\Table(
 *     name="users2teams", 
 *     uniqueConstraints={
 *        @UniqueConstraint(name="usersteams", columns={"users_id", "teams_id"})
 *    },
 *    indexes={
 *        @ORM\Index(name="fk_users2teams_teams_id", columns={"teams_id"}), 
 *        @ORM\Index(name="fk_users2teams_users_id", columns={"users_id"})
 *    }
 * )
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"users":"exact","teams":"exact"})
 * @ORM\Entity
 */
class Users2teams
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams", inversedBy="users2teams")
     * @ORM\JoinColumn(name="teams_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $teams;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="users2teams")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="userid", onDelete="CASCADE")
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeams(): ?Teams
    {
        return $this->teams;
    }

    public function setTeams(?Teams $teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }


}
