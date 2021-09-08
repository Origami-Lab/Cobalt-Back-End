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
        $output->users2teams = $data->getUsers2teams();
        $users = [];
        if(!empty($output->users2teams)){
            foreach($output->users2teams as $users2teams){
                $user =  $users2teams->getUsers();
                $user->users2teams_id = $users2teams->getId();
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