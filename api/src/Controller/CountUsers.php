<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

#[AsController]
class CountUsers extends AbstractController
{
    
    #[Route('/count_users', methods: ['GET'])]
    public function get_list()
    {
        $em = $this->getDoctrine()->getManager();
        $users = [
            'total' => $em->getRepository(Users::class)->count([]),
            'byRoles' => []
        ];
        $roles = $this->getParameter('app.user_roles');
        if($roles){
            foreach($roles as $role){
                $roleName = $role['name'];
                if($roleName){
                    $qb = $em->createQueryBuilder();
                    $qb->select($qb->expr()->count('u'))
                        ->from(Users::class, 'u')
                        ->where('u.roles LIKE ?1')
                        ->setParameter(1, "%".$roleName."%");
                    $query = $qb->getQuery();
                    $byRole = [
                        'name' => $roleName,
                        'count' => (int) $query->getSingleScalarResult()
                    ];
                    $users['byRoles'][] = $byRole;
                }
            }
        }
        return new JsonResponse($users);
    }
    
}
