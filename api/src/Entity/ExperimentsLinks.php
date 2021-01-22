<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * ExperimentsLinks
 *
 * @ORM\Table(name="experiments_links", indexes={@ORM\Index(name="fk_experiments_links_experiments_id", columns={"experiment_id"}), @ORM\Index(name="fk_experiments_links_users_userid", columns={"userid"})})
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"experimentid": "/experiments/id"})
 * @ORM\Entity
 */
class ExperimentsLinks
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
     * @ORM\Column(name="link", type="text", length=65535, nullable=false)
     */
    private $link;

   /**
     * @var \Experiments
     *
     * @ORM\ManyToOne(targetEntity="Experiments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experiment_id", referencedColumnName="id")
     * })
     */
    private $experimentid;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getExperimentId(): ?Experiments
    {
        return $this->experimentid;
    }

    public function setExperimentId(?Experiments $experimentid): self
    {
        $this->experimentid = $experimentid;

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
