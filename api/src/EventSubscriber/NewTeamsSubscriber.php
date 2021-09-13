<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\Teams;
use App\Entity\Users2teams;

final class NewTeamsSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['assignUsers2Teams', EventPriorities::POST_WRITE],
        ];
    }

    public function assignUsers2Teams(ViewEvent $event): void
    {
        $team = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$team instanceof Teams || Request::METHOD_POST !== $method) {
            return;
        }
        if (!$token = $this->tokenStorage->getToken()) {
            return ;
        }
        
        if (!$token->isAuthenticated()) {
            return ;
        }
        if (!$user = $token->getUser()) {
            return ;
        }
        $users2teams = new Users2teams();
        $users2teams->setTeams($team);
        $users2teams->setUsers($user);
        $this->entityManager->persist($users2teams);
        $this->entityManager->flush();
    }
}