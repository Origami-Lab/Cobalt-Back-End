<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperimentsTemplates
 *
 * @ORM\Table(name="experiments_templates", indexes={@ORM\Index(name="fk_experiments_templates_teams_id", columns={"team"})})
 * @ApiResource
 * @ORM\Entity
 */
class ExperimentsTemplates
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
     * @var string|null
     *
     * @ORM\Column(name="body", type="text", length=65535, nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userid", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="canread", type="string", length=255, nullable=false)
     */
    private $canread;

    /**
     * @var string
     *
     * @ORM\Column(name="canwrite", type="string", length=255, nullable=false)
     */
    private $canwrite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $ordering;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team", referencedColumnName="id")
     * })
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
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

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getCanread(): ?string
    {
        return $this->canread;
    }

    public function setCanread(string $canread): self
    {
        $this->canread = $canread;

        return $this;
    }

    public function getCanwrite(): ?string
    {
        return $this->canwrite;
    }

    public function setCanwrite(string $canwrite): self
    {
        $this->canwrite = $canwrite;

        return $this;
    }

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(?int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }

    public function getTeam(): ?Teams
    {
        return $this->team;
    }

    public function setTeam(?Teams $team): self
    {
        $this->team = $team;

        return $this;
    }


}
