<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Experiments2labelsOutput;
use App\Entity\Experiments2labels;

final class Experiments2labelsOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new Experiments2labelsOutput();
        $output->id = $data->getId();
        $output->experimentId = !empty($data->getExperiments()) ? $data->getExperiments()->getId() : null;
        $output->labelId = !empty($data->getLabels()) ? $data->getLabels()->getId() : null;
        $output->label = !empty($data->getLabels()) ? $data->getLabels()->getLabel() : null;
        $output->color = !empty($data->getLabels()) ? $data->getLabels()->getColor() : null;
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Experiments2labelsOutput::class === $to && $data instanceof Experiments2labels;
    }
}