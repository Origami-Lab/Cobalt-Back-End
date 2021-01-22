<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users2teamGroups
 *
 * @ORM\Table(name="users2team_groups")
 * @ApiResource
 * @ORM\Entity
 */
class Users2teamGroups
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
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="groupid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $groupid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getGroupid(): ?int
    {
        return $this->groupid;
    }

    public function setGroupid(int $groupid): self
    {
        $this->groupid = $groupid;

        return $this;
    }


}
