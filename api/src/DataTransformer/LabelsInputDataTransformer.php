<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Labels;

final class LabelsInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $labels = new Labels();
        $label = $data->label;
        $color = $data->color;
        if(!$color){
            $color = '';
        }
        $labels->setLabel($label);
        $labels->setColor($color);
        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Labels) {
          return false;
        }
        return Labels::class === $to && null !== ($context['input']['class'] ?? null);
    }
}