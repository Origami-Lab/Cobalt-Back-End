<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items", indexes={@ORM\Index(name="fk_items_teams_id", columns={"team"})})
 * @ApiResource
 * @ORM\Entity
 */
class Items
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body", type="text", length=16777215, nullable=true)
     */
    private $body;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="rating", type="boolean", nullable=true)
     */
    private $rating = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $category;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="locked", type="boolean", nullable=true)
     */
    private $locked;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lockedby", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $lockedby;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lockedwhen", type="datetime", nullable=true)
     */
    private $lockedwhen;

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="canread", type="string", length=255, nullable=false, options={"default"="team"})
     */
    private $canread = 'team';

    /**
     * @var string
     *
     * @ORM\Column(name="canwrite", type="string", length=255, nullable=false, options={"default"="team"})
     */
    private $canwrite = 'team';

    /**
     * @var bool
     *
     * @ORM\Column(name="available", type="boolean", nullable=false, options={"default"="1"})
     */
    private $available = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastchange", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastchange = 'CURRENT_TIMESTAMP';

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
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

    public function getRating(): ?bool
    {
        return $this->rating;
    }

    public function setRating(?bool $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(?bool $locked): self
    {
        $this->locked = $locked;

        return $this;
    }

    public function getLockedby(): ?int
    {
        return $this->lockedby;
    }

    public function setLockedby(?int $lockedby): self
    {
        $this->lockedby = $lockedby;

        return $this;
    }

    public function getLockedwhen(): ?\DateTimeInterface
    {
        return $this->lockedwhen;
    }

    public function setLockedwhen(?\DateTimeInterface $lockedwhen): self
    {
        $this->lockedwhen = $lockedwhen;

        return $this;
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

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getLastchange(): ?\DateTimeInterface
    {
        return $this->lastchange;
    }

    public function setLastchange(?\DateTimeInterface $lastchange): self
    {
        $this->lastchange = $lastchange;

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
