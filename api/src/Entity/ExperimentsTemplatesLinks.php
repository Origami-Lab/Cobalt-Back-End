<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperimentsTemplatesLinks
 *
 * @ORM\Table(name="experiments_templates_links", indexes={@ORM\Index(name="fk_experiments_templates_links_items_id", columns={"item_id"}), @ORM\Index(name="fk_experiments_templates_links_items_id2", columns={"link_id"})})
 * @ApiResource
 * @ORM\Entity
 */
class ExperimentsTemplatesLinks
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
     * @var \ExperimentsTemplates
     *
     * @ORM\ManyToOne(targetEntity="ExperimentsTemplates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \Items
     *
     * @ORM\ManyToOne(targetEntity="Items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="link_id", referencedColumnName="id")
     * })
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?ExperimentsTemplates
    {
        return $this->item;
    }

    public function setItem(?ExperimentsTemplates $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getLink(): ?Items
    {
        return $this->link;
    }

    public function setLink(?Items $link): self
    {
        $this->link = $link;

        return $this;
    }


}
