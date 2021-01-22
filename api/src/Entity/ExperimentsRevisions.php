<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperimentsRevisions
 *
 * @ORM\Table(name="experiments_revisions")
 * @ApiResource
 * @ORM\Entity
 */
class ExperimentsRevisions
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
     * @var int
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=16777215, nullable=false)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="savedate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $savedate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $userid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getSavedate(): ?\DateTimeInterface
    {
        return $this->savedate;
    }

    public function setSavedate(\DateTimeInterface $savedate): self
    {
        $this->savedate = $savedate;

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


}
