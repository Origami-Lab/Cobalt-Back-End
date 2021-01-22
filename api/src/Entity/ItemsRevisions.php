<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsRevisions
 *
 * @ORM\Table(name="items_revisions", indexes={@ORM\Index(name="fk_items_revisions_items_id", columns={"item_id"}), @ORM\Index(name="fk_items_revisions_users_userid", columns={"userid"})})
 * @ApiResource
 * @ORM\Entity
 */
class ItemsRevisions
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
     * @var \Items
     *
     * @ORM\ManyToOne(targetEntity="Items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="userid")
     * })
     */
    private $userid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getItem(): ?Items
    {
        return $this->item;
    }

    public function setItem(?Items $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getUserid(): ?Users
    {
        return $this->userid;
    }

    public function setUserid(?Users $userid): self
    {
        $this->userid = $userid;

        return $this;
    }


}
