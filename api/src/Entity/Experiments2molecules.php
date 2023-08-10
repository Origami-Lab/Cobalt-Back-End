<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping\UniqueConstraint;
use App\Dto\Experiments2moleculesOutput;
use App\Dto\Experiments2moleculesInput;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experiments2molecules
 *
 * @ORM\Table(
 *     name="experiments2molecules", 
 *     uniqueConstraints={
 *        @UniqueConstraint(name="experiments2molecules", columns={"experiments_id", "molecules_id"})
 *    },
 *    indexes={
 *        @ORM\Index(name="fk_experiments2molecules_experiments_id", columns={"experiments_id"}), 
 *        @ORM\Index(name="fk_experiments2molecules_molecules_id", columns={"molecules_id"})
 *    }
 * )
 * @ApiResource(
 *     output=Experiments2moleculesOutput::class,
 *     input=Experiments2moleculesInput::class
 * )
 * @ApiFilter(SearchFilter::class, properties={"experiments":"exact","molecules":"exact"})
 * @ORM\Entity
 */
class Experiments2molecules
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Experiments
     *
     * @ORM\ManyToOne(targetEntity="Experiments", inversedBy="experiments2molecules", fetch="EAGER")
     * @ORM\JoinColumn(name="experiments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $experiments;

    /**
     * @var \Molecules
     *
     * @ORM\ManyToOne(targetEntity="Molecules", inversedBy="experiments2molecules", fetch="EAGER")
     * @ORM\JoinColumn(name="molecules_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $molecules;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperiments(): ?Experiments
    {
        return $this->experiments;
    }

    public function setExperiments(?Experiments $experiments): self
    {
        $this->experiments = $experiments;

        return $this;
    }

    public function getMolecules(): ?Molecules
    {
        return $this->molecules;
    }

    public function setMolecules(?Molecules $molecules): self
    {
        $this->molecules = $molecules;

        return $this;
    }


}
