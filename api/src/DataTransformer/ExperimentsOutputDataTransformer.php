<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\ExperimentsOutput;
use App\Entity\Experiments;

final class ExperimentsOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $userId = $data->getUserid();
        if($userId){
            $userId = '/users/'.$data->getUserid()->getId();
        }else{
            $userId = null;
        }
        $output = new ExperimentsOutput();
        $output->id = $data->getId();
        $output->title = $data->getTitle();
        $output->author = $data->getAuthor();
        $output->status = $data->getStatus();
        $output->startdate = $output->startDate = $data->getStartDate();
        $output->duedate = $output->dueDate = $data->getDueDate();
        $output->datetime = $data->getDatetime();
        $output->userid = $userId;
        $output->experiments2labels = $data->getExperiments2labels();
        $output->experiments2molecules = $data->getExperiments2molecules();
        $output->padid = $data->getPadid();
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ExperimentsOutput::class === $to && $data instanceof Experiments;
    }
}