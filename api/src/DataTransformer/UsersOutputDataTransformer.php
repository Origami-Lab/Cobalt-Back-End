<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\UsersOutput;
use App\Entity\Users;

final class UsersOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = new UsersOutput();
        $output->userid = $data->getUserid();
        $output->name = $data->getName();
        $output->email = $data->getEmail();
        $output->avatar = $data->getAvatar();
        $output->users2teams = $data->users2teams;
        $teams = [];
        if(!empty($data->users2teams)){
            foreach($data->users2teams as $users2teams){
                $team =  $users2teams->getTeams();
                $teamData = [
                    'id' => $team->getId(),
                    'name' => $team->getName()
                ];
                $teams[] = $teamData;
            }
        }
        $output->teams = $teams;
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return UsersOutput::class === $to && $data instanceof Users;
    }
}