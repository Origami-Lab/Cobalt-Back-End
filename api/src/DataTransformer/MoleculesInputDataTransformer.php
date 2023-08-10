<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Molecules;

final class MoleculesInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $molecules = new Molecules();
        $molecule = $data->molecule;
        $molecules->setMolecule($molecule);
        return $molecules;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Molecules) {
          return false;
        }
        return Molecules::class === $to && null !== ($context['input']['class'] ?? null);
    }
}