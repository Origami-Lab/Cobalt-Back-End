<?php 
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;

class AuthenticationSuccessListener{
    
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();
        if (!$user instanceof UserInterface) {
            return;
        }
        $data['data'] = array(
            'userid' => $user->getUserid(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'avatar' => $user->getAvatar(),
            'roles' => $user->getRoles()
        );
        $event->setData($data);
        $user = $this->entityManager->find(Users::class, $user->getUserid());
        $user->setLastLogin(new \Datetime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
