<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Experiments;
use App\Entity\Molecules;
use App\Entity\Experiments2molecules;

final class Experiments2moleculesInputDataTransformer implements DataTransformerInterface
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
        $experiments2molecules = new Experiments2molecules();
        $experimentId = $data->experimentId;
        $experiments = $this->entityManager->find(Experiments::class, $experimentId);
        $moleculeId = $data->moleculeId;
        $molecule = $data->molecule;
        if(!$moleculeId && $molecule){
            $molecules = new Molecules();
            $molecules->setMolecule($molecule);
            $this->entityManager->persist($molecules);
            $this->entityManager->flush();
        }else{
            $molecules = $this->entityManager->find(Molecules::class, $moleculeId);
        }
        $experiments2molecules->setExperiments($experiments);
        $experiments2molecules->setMolecules($molecules);
        return $experiments2molecules;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Experiments2molecules) {
          return false;
        }
        return Experiments2moleculesOutput::class === $to && null !== ($context['input']['class'] ?? null);
    }
}