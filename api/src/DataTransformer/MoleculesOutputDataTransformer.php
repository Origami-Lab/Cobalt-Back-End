<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\MoleculesOutput;
use App\Entity\Molecules;

final class MoleculesOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new MoleculesOutput();
        $output->id = $data->getId();
        $output->molecule = $data->getMolecule();
        $output->experiments2molecules = $data->getExperiments2molecules();
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return MoleculesOutput::class === $to && $data instanceof Molecules;
    }
}