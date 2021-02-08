<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;



/**
 * Experiments
 *
 * @ORM\Table(name="experiments", indexes={@ORM\Index(name="fk_experiments_users_userid", columns={"userid"})})
 * @ApiResource(
 *     attributes={
 *      "pagination_items_per_page"=10
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"title": "word_start"})
 * @ApiFilter(DateFilter::class, properties={"startdate"})
 * @ORM\Entity
 */
class Experiments
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

 
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;


    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=true)
     * 
     */
    private $startdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="duedate", type="datetime", nullable=true)
     */
    private $duedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastchange", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastchange = 'CURRENT_TIMESTAMP';

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartDate(?\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->duedate;
    }

    public function setDueDate(?\DateTimeInterface $duedate): self
    {
        $this->duedate = $duedate;

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

    public function getLastchange(): ?\DateTimeInterface
    {
        return $this->lastchange;
    }

    public function setLastchange(?\DateTimeInterface $lastchange): self
    {
        $this->lastchange = $lastchange;

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
