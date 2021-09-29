<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\LabelsOutput;
use App\Entity\Labels;

final class LabelsOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new LabelsOutput();
        $output->id = $data->getId();
        $output->label = $data->getLabel();
        $output->color = $data->getColor();
        $output->experiments2labels = $data->getExperiments2labels();
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return LabelsOutput::class === $to && $data instanceof Labels;
    }
}