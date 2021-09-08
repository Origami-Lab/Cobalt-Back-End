<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Dto\TeamsOutput;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ApiResource(
 *     output=TeamsOutput::class,
 *     attributes={"security"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *     collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={ 
 *         "get" = { "security" = "is_granted('IS_AUTHENTICATED_FULLY')" },
 *         "put" = { "security" = "is_granted('ROLE_ADMIN')" },
 *         "delete" = { "security" = "is_granted('ROLE_ADMIN')" } 
 *     }
 * )
 * @ApiFilter(OrderFilter::class, properties={"id","datetime"})
 * @ORM\Entity
 */
class Teams
{
    public function __construct()
    {
        $this->datetime = new \DateTime();
    }
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
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime;
    
    /**
     * @ORM\OneToMany(targetEntity="Users2teams", mappedBy="teams")
     * @ApiSubresource
     */
    private $users2teams;
    

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
    
    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
    
    public function getUsers2teams() {
        return $this->users2teams;
    }
}
