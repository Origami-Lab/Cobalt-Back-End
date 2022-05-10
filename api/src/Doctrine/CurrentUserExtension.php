<?php
namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Teams;
use App\Entity\Experiments;
use App\Entity\Users;

final class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;
    
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        if ($this->security->isGranted('ROLE_ADMIN') || null === $user = $this->security->getUser()) {
            return;
        }
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $userId = $user->getId();
       
        if(Teams::class === $resourceClass || Experiments::class === $resourceClass){
            $teamIds = $userIds = [];
            $users2teams = $this->entityManager->getRepository('App\Entity\Users2teams')->findBy(array('users' => $userId));
            if($users2teams){
                foreach($users2teams as $users2team){
                    $teamIds[] = $users2team->getTeams()->getId();
                    $teamUsers = $users2team->getTeams()->getUsers2teams();
                    if($teamUsers){
                        foreach($teamUsers as $teamUser){
                            $userIds[] = $teamUser->getUsers()->getId();
                        }
                    }
                }
            }
            $teamIds = array_unique($teamIds);
            $userIds = array_unique($userIds);
            if($teamIds){
                $teamIds = implode(',',$teamIds);
            }else{
                $teamIds = 0;
            }
            if($userIds){
                $userIds = implode(',',$userIds);
            }else{
                $userIds = $userId;
            }
            if(Teams::class === $resourceClass){
                $queryBuilder->andWhere(sprintf('%s.id IN (%s)', $rootAlias, $teamIds));
            }
            if(Experiments::class === $resourceClass){
                $queryBuilder->andWhere(sprintf('%s.userid IN (%s)', $rootAlias, $userIds));
                if(in_array($userId, array(20, 34, 36, 37, 38, 39, 40))){
                    $queryBuilder->orWhere(sprintf('%s.id IN (%s)', $rootAlias, '71,72'));
                }
            }
        }
    }
}