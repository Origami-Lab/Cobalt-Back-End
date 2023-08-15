<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Dto\MoleculesOutput;
use App\Dto\MoleculesInput;

/**
 * Molecules
 *
 * @ORM\Table(name="molecules", indexes={@ORM\Index(name="molecule_idx", columns={"molecule"})})
 * @ApiResource(
 *     output=MoleculesOutput::class,
 *     input=MoleculesInput::class
 * )
 * @ApiFilter(SearchFilter::class, properties={"molecule": "ipartial", "experiments2molecules.experiments":"exact"})
 * @ORM\Entity
 */
class Molecules
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
     * @ORM\Column(name="molecule", type="string", length=255, nullable=false)
     */
    private $molecule;

    /**
     * @var string
     *
     * @ORM\Column(name="fullmolecule", type="text", length=65535, nullable=false)
     */
    private $fullmolecule;

    /**
     * @ORM\OneToMany(targetEntity="Experiments2molecules", mappedBy="molecules", fetch="EAGER")
     */
    private $experiments2molecules;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMolecule(): ?string
    {
        return $this->fullmolecule ? $this->fullmolecule : $this->molecule;
    }

    public function setMolecule(string $molecule): self
    {
        $this->molecule = $molecule;

        return $this;
    }

    public function getFullmolecule(): ?string
    {
        return $this->fullmolecule ? $this->fullmolecule : $this->molecule;
    }

    public function setFullmolecule(string $fullmolecule): self
    {
        $this->fullmolecule = $fullmolecule;
        return $this;
    }

    public function getExperiments2molecules()
    {
        return $this->experiments2molecules;
    }
}
