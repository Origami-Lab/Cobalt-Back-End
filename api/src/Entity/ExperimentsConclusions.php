<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * ExperimentsConclusions
 *
 * @ORM\Table(name="experiments_conclusions", indexes={@ORM\Index(name="fk_experiments_conclusions_experiments_id", columns={"experiment_id"}), @ORM\Index(name="fk_experiments_conclusions_users_userid", columns={"userid"})})
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"experimentid": "exact"})
 * @ORM\Entity
 */
class ExperimentsConclusions
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
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusions", type="text", length=65535, nullable=false)
     */
    private $conclusions;

  /**
     * @var \Experiments
     *
     * @ORM\ManyToOne(targetEntity="Experiments", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experiment_id", referencedColumnName="id", onDelete="CASCADE")
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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getConclusions(): ?string
    {
        return $this->conclusions;
    }

    public function setConclusions(string $conclusions): self
    {
        $this->conclusions = $conclusions;

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
