<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ApiResource
 * @ORM\Entity
 */
class Config
{
    /**
     * @var string
     *
     * @ORM\Column(name="conf_name", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $confName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conf_value", type="text", length=65535, nullable=true)
     */
    private $confValue;

    public function getConfName(): ?string
    {
        return $this->confName;
    }

    public function getConfValue(): ?string
    {
        return $this->confValue;
    }

    public function setConfValue(?string $confValue): self
    {
        $this->confValue = $confValue;

        return $this;
    }


}
