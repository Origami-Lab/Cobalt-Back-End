<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Experiments2moleculesOutput;
use App\Entity\Experiments2molecules;

final class Experiments2moleculesOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new Experiments2moleculesOutput();
        $output->id = $data->getId();
        $output->experimentId = !empty($data->getExperiments()) ? $data->getExperiments()->getId() : null;
        $output->moleculeId = !empty($data->getMolecules()) ? $data->getMolecules()->getId() : null;
        $output->molecule = !empty($data->getMolecules()) ? $data->getMolecules()->getMolecule() : null;
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Experiments2molecules::class === $to && $data instanceof Experiments2molecules;
    }
}