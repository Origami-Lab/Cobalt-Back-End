<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping\UniqueConstraint;
use App\Dto\Experiments2labelsOutput;
use App\Dto\Experiments2labelsInput;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experiments2labels
 *
 * @ORM\Table(
 *     name="experiments2labels", 
 *     uniqueConstraints={
 *        @UniqueConstraint(name="experiments2labels", columns={"experiments_id", "labels_id"})
 *    },
 *    indexes={
 *        @ORM\Index(name="fk_experiments2labels_experiments_id", columns={"experiments_id"}), 
 *        @ORM\Index(name="fk_experiments2labels_labels_id", columns={"labels_id"})
 *    }
 * )
 * @ApiResource(
 *     output=Experiments2labelsOutput::class,
 *     input=Experiments2labelsInput::class
 * )
 * @ApiFilter(SearchFilter::class, properties={"experiments":"exact","labels":"exact"})
 * @ORM\Entity
 */
class Experiments2labels
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
     * @ORM\ManyToOne(targetEntity="Experiments", inversedBy="experiments2labels", fetch="EAGER")
     * @ORM\JoinColumn(name="experiments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $experiments;

    /**
     * @var \Labels
     *
     * @ORM\ManyToOne(targetEntity="Labels", inversedBy="experiments2labels", fetch="EAGER")
     * @ORM\JoinColumn(name="labels_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $labels;

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

    public function getLabels(): ?Labels
    {
        return $this->labels;
    }

    public function setLabels(?Labels $labels): self
    {
        $this->labels = $labels;

        return $this;
    }


}
