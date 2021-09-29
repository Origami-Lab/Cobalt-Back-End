<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Dto\LabelsOutput;
use App\Dto\LabelsInput;

/**
 * Labels
 *
 * @ORM\Table(name="labels", indexes={@ORM\Index(name="label_idx", columns={"label"})})
 * @ApiResource(
 *     output=LabelsOutput::class,
 *     input=LabelsInput::class
 * )
 * @ApiFilter(SearchFilter::class, properties={"label": "ipartial", "experiments2labels.experiments":"exact"})
 * @ORM\Entity
 */
class Labels
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
     * @ORM\Column(name="label", type="string", length=255, nullable=false, unique=true)
     */
    private $label;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private $color;
    
    /**
     * @ORM\OneToMany(targetEntity="Experiments2labels", mappedBy="labels", fetch="EAGER")
     */
    private $experiments2labels;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
    
    public function getColor(): ?string
    {
        return $this->color;
    }
    
    public function setColor(string $color): self
    {
        if(!$color){
            $color = '#';
            $colorHex = ["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];
            for($x=0; $x < 6; $x++){
                $color .= $colorHex[array_rand($colorHex, 1)]  ;
            }
            $color =  substr($color, 0, 7);
        }
        $this->color = $color;
        
        return $this;
    }
    
    public function getExperiments2labels()
    {
        return $this->experiments2labels;
    }
}
