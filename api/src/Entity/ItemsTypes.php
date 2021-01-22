<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsTypes
 *
 * @ORM\Table(name="items_types", indexes={@ORM\Index(name="fk_items_types_teams_id", columns={"team"})})
 * @ApiResource
 * @ORM\Entity
 */
class ItemsTypes
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
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=6, nullable=true, options={"default"="000000"})
     */
    private $color = '000000';

    /**
     * @var string|null
     *
     * @ORM\Column(name="template", type="text", length=65535, nullable=true)
     */
    private $template;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $ordering;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="bookable", type="boolean", nullable=true)
     */
    private $bookable = '0';

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

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

    public function getBookable(): ?bool
    {
        return $this->bookable;
    }

    public function setBookable(?bool $bookable): self
    {
        $this->bookable = $bookable;

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
