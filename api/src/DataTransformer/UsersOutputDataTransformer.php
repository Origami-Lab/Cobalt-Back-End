<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\UsersOutput;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;
use App\Entity\Experiments;

final class UsersOutputDataTransformer implements DataTransformerInterface
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
        $output = new UsersOutput();
        $output->userid = $data->getUserid();
        $output->name = $data->getName();
        $output->email = $data->getEmail();
        $output->avatar = $data->getAvatar();
        $output->roles = $data->getRoles();
        $output->users2teams = $data->getUsers2teams();
        $lastActivity = $data->getLastLogin();
        $output->lastActivity = $lastActivity;
        $teams = [];
        if(!empty($output->users2teams)){
            foreach($output->users2teams as $users2teams){
                $team =  $users2teams->getTeams();
                $totalUsers = $team->getUsers2teams()->count();
                $userAvatars = [];
                foreach($team->getUsers2teams() as $temp){
                    $tempUser = $temp->getUsers();
                    $userAvatars[] = [
                        'avatar' => $tempUser->getAvatar(),
                        'email' => $tempUser->getEmail(),
                        'name' => $tempUser->getName()
                    ];
                    if(count($userAvatars) == 3){
                        break;
                    }
                }
                $teamData = [
                    'id' => $team->getId(),
                    'name' => $team->getName(),
                    'users2teamsId' => $users2teams->getId(),
                    'totalUsers' => $totalUsers,
                    'userAvatars' => $userAvatars
                ];
                $teams[] = $teamData;
            }
        }
        $output->teams = $teams;
        $totalExperiments = $data->getExperiments()->count();
        $output->totalExperiments = $totalExperiments;
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