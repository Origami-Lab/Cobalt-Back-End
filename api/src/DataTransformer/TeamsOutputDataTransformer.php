<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\TeamsOutput;
use App\Entity\Teams;

final class TeamsOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new TeamsOutput();
        $output->name = $data->getName();
        $output->id = $data->getId();
        $output->users2teams = $data->users2teams;
        $users = [];
        if(!empty($data->users2teams)){
            foreach($data->users2teams as $users2teams){
                $user =  $users2teams->getUsers();
                $users[] = $user;
            }
        }
        $output->users = $users;
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return TeamsOutput::class === $to && $data instanceof Teams;
    }
}