<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperimentContent
 *
 * @ORM\Table(name="experiments_content", indexes={@ORM\Index(name="fk_experiments_content_experiments_id", columns={"item_id"}), @ORM\Index(name="fk_experiments_content_users_userid", columns={"userid"})})
 * @ApiResource
 * @ORM\Entity
 */
class ExperimentContent
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
     * @ORM\Column(name="goal", type="text", length=65535, nullable=false)
     */
    private $goal;

     /**
     * @var string
     *
     * @ORM\Column(name="procedure", type="text", length=65535, nullable=false)
     */
    private $procedure;

     /**
     * @var string
     *
     * @ORM\Column(name="results", type="text", length=65535, nullable=false)
     */
    private $results;

    /**
     * @var \Experiments
     *
     * @ORM\ManyToOne(targetEntity="Experiments")
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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getProcedure(): ?string
    {
        return $this->procedure;
    }

    public function setProcedure(string $procedure): self
    {
        $this->procedure = $procedure;

        return $this;
    }

    public function getResults(): ?string
    {
        return $this->results;
    }

    public function setResults(string $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getItem(): ?Experiments
    {
        return $this->item;
    }

    public function setItem(?Experiments $item): self
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
