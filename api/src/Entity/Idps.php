<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idps
 *
 * @ORM\Table(name="idps")
 * @ApiResource
 * @ORM\Entity
 */
class Idps
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
     * @var string
     *
     * @ORM\Column(name="entityid", type="string", length=255, nullable=false)
     */
    private $entityid;

    /**
     * @var string
     *
     * @ORM\Column(name="sso_url", type="string", length=255, nullable=false)
     */
    private $ssoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="sso_binding", type="string", length=255, nullable=false)
     */
    private $ssoBinding;

    /**
     * @var string
     *
     * @ORM\Column(name="slo_url", type="string", length=255, nullable=false)
     */
    private $sloUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="slo_binding", type="string", length=255, nullable=false)
     */
    private $sloBinding;

    /**
     * @var string
     *
     * @ORM\Column(name="x509", type="text", length=65535, nullable=false)
     */
    private $x509;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '0';

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

    public function getEntityid(): ?string
    {
        return $this->entityid;
    }

    public function setEntityid(string $entityid): self
    {
        $this->entityid = $entityid;

        return $this;
    }

    public function getSsoUrl(): ?string
    {
        return $this->ssoUrl;
    }

    public function setSsoUrl(string $ssoUrl): self
    {
        $this->ssoUrl = $ssoUrl;

        return $this;
    }

    public function getSsoBinding(): ?string
    {
        return $this->ssoBinding;
    }

    public function setSsoBinding(string $ssoBinding): self
    {
        $this->ssoBinding = $ssoBinding;

        return $this;
    }

    public function getSloUrl(): ?string
    {
        return $this->sloUrl;
    }

    public function setSloUrl(string $sloUrl): self
    {
        $this->sloUrl = $sloUrl;

        return $this;
    }

    public function getSloBinding(): ?string
    {
        return $this->sloBinding;
    }

    public function setSloBinding(string $sloBinding): self
    {
        $this->sloBinding = $sloBinding;

        return $this;
    }

    public function getX509(): ?string
    {
        return $this->x509;
    }

    public function setX509(string $x509): self
    {
        $this->x509 = $x509;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }


}
