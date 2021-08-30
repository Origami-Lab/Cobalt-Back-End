<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(name="usergroups")
 * @ApiResource
 * @ORM\Entity
 */
class Groups
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_sysadmin", type="boolean", nullable=false)
     */
    private $isSysadmin;

    /**
     * @var string
     *
     * @ORM\Column(name="is_admin", type="text", length=65535, nullable=false)
     */
    private $isAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="can_lock", type="text", length=65535, nullable=false)
     */
    private $canLock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsSysadmin(): ?bool
    {
        return $this->isSysadmin;
    }

    public function setIsSysadmin(bool $isSysadmin): self
    {
        $this->isSysadmin = $isSysadmin;

        return $this;
    }

    public function getIsAdmin(): ?string
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(string $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getCanLock(): ?string
    {
        return $this->canLock;
    }

    public function setCanLock(string $canLock): self
    {
        $this->canLock = $canLock;

        return $this;
    }


}
