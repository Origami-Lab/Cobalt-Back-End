<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Experiments;
use App\Entity\Labels;
use App\Entity\Experiments2labels;

final class Experiments2labelsInputDataTransformer implements DataTransformerInterface
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $experiments2labels = new Experiments2labels();
        $experimentId = $data->experimentId;
        $experiments = $this->entityManager->find(Experiments::class, $experimentId);
        $labelId = $data->labelId;
        $label = $data->label;
        $color = $data->color;
        if(!$labelId && $label){
            if(!$color){
                $color = '';
            }
            $labels = new Labels();
            $labels->setLabel($label);
            $labels->setColor($color);
            $this->entityManager->persist($labels);
            $this->entityManager->flush();
        }else{
            $labels = $this->entityManager->find(Labels::class, $labelId);
        }
        $experiments2labels->setExperiments($experiments);
        $experiments2labels->setLabels($labels);
        return $experiments2labels;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Experiments2labels) {
          return false;
        }
        return Experiments2labels::class === $to && null !== ($context['input']['class'] ?? null);
    }
}