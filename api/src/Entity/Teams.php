<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ApiResource
 * @ORM\Entity
 */
class Teams
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
     * @ORM\Column(name="deletable_xp", type="boolean", nullable=false, options={"default"="1"})
     */
    private $deletableXp = true;

    /**
     * @var string
     *
     * @ORM\Column(name="link_name", type="text", length=65535, nullable=false)
     */
    private $linkName;

    /**
     * @var string
     *
     * @ORM\Column(name="link_href", type="text", length=65535, nullable=false)
     */
    private $linkHref;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="stamplogin", type="text", length=65535, nullable=true)
     */
    private $stamplogin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stamppass", type="text", length=65535, nullable=true)
     */
    private $stamppass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stampprovider", type="text", length=65535, nullable=true)
     */
    private $stampprovider;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stampcert", type="text", length=65535, nullable=true)
     */
    private $stampcert;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stamphash", type="string", length=10, nullable=true, options={"default"="sha256"})
     */
    private $stamphash = 'sha256';

    /**
     * @var string|null
     *
     * @ORM\Column(name="orgid", type="string", length=255, nullable=true)
     */
    private $orgid;

    /**
     * @var bool
     *
     * @ORM\Column(name="public_db", type="boolean", nullable=false)
     */
    private $publicDb = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="force_canread", type="string", length=255, nullable=false, options={"default"="team"})
     */
    private $forceCanread = 'team';

    /**
     * @var string
     *
     * @ORM\Column(name="force_canwrite", type="string", length=255, nullable=false, options={"default"="user"})
     */
    private $forceCanwrite = 'user';

    /**
     * @var bool
     *
     * @ORM\Column(name="do_force_canread", type="boolean", nullable=false)
     */
    private $doForceCanread = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="do_force_canwrite", type="boolean", nullable=false)
     */
    private $doForceCanwrite = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false, options={"default"="1"})
     */
    private $visible = true;

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

    public function getDeletableXp(): ?bool
    {
        return $this->deletableXp;
    }

    public function setDeletableXp(bool $deletableXp): self
    {
        $this->deletableXp = $deletableXp;

        return $this;
    }

    public function getLinkName(): ?string
    {
        return $this->linkName;
    }

    public function setLinkName(string $linkName): self
    {
        $this->linkName = $linkName;

        return $this;
    }

    public function getLinkHref(): ?string
    {
        return $this->linkHref;
    }

    public function setLinkHref(string $linkHref): self
    {
        $this->linkHref = $linkHref;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getStamplogin(): ?string
    {
        return $this->stamplogin;
    }

    public function setStamplogin(?string $stamplogin): self
    {
        $this->stamplogin = $stamplogin;

        return $this;
    }

    public function getStamppass(): ?string
    {
        return $this->stamppass;
    }

    public function setStamppass(?string $stamppass): self
    {
        $this->stamppass = $stamppass;

        return $this;
    }

    public function getStampprovider(): ?string
    {
        return $this->stampprovider;
    }

    public function setStampprovider(?string $stampprovider): self
    {
        $this->stampprovider = $stampprovider;

        return $this;
    }

    public function getStampcert(): ?string
    {
        return $this->stampcert;
    }

    public function setStampcert(?string $stampcert): self
    {
        $this->stampcert = $stampcert;

        return $this;
    }

    public function getStamphash(): ?string
    {
        return $this->stamphash;
    }

    public function setStamphash(?string $stamphash): self
    {
        $this->stamphash = $stamphash;

        return $this;
    }

    public function getOrgid(): ?string
    {
        return $this->orgid;
    }

    public function setOrgid(?string $orgid): self
    {
        $this->orgid = $orgid;

        return $this;
    }

    public function getPublicDb(): ?bool
    {
        return $this->publicDb;
    }

    public function setPublicDb(bool $publicDb): self
    {
        $this->publicDb = $publicDb;

        return $this;
    }

    public function getForceCanread(): ?string
    {
        return $this->forceCanread;
    }

    public function setForceCanread(string $forceCanread): self
    {
        $this->forceCanread = $forceCanread;

        return $this;
    }

    public function getForceCanwrite(): ?string
    {
        return $this->forceCanwrite;
    }

    public function setForceCanwrite(string $forceCanwrite): self
    {
        $this->forceCanwrite = $forceCanwrite;

        return $this;
    }

    public function getDoForceCanread(): ?bool
    {
        return $this->doForceCanread;
    }

    public function setDoForceCanread(bool $doForceCanread): self
    {
        $this->doForceCanread = $doForceCanread;

        return $this;
    }

    public function getDoForceCanwrite(): ?bool
    {
        return $this->doForceCanwrite;
    }

    public function setDoForceCanwrite(bool $doForceCanwrite): self
    {
        $this->doForceCanwrite = $doForceCanwrite;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }


}
