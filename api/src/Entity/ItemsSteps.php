<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsSteps
 *
 * @ORM\Table(name="items_steps", indexes={@ORM\Index(name="fk_items_steps_items_id", columns={"item_id"})})
 * @ApiResource
 * @ORM\Entity
 */
class ItemsSteps
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
     * @ORM\Column(name="body", type="text", length=65535, nullable=false)
     */
    private $body;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $ordering;

    /**
     * @var bool
     *
     * @ORM\Column(name="finished", type="boolean", nullable=false)
     */
    private $finished = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="finished_time", type="datetime", nullable=true)
     */
    private $finishedTime;

    /**
     * @var \Items
     *
     * @ORM\ManyToOne(targetEntity="Items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

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

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(?int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }

    public function getFinishedTime(): ?\DateTimeInterface
    {
        return $this->finishedTime;
    }

    public function setFinishedTime(?\DateTimeInterface $finishedTime): self
    {
        $this->finishedTime = $finishedTime;

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


}
