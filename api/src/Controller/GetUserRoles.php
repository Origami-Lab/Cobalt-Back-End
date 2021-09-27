<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[AsController]
class GetUserRoles extends AbstractController
{
    #[Route('/user_roles', methods: ['GET'])]
    public function get_list()
    {
        $roles = $this->getParameter('app.user_roles');
        return new JsonResponse($roles);
    }
    
}
