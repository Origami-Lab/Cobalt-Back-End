<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class AssignOwnerSubscriber implements EventSubscriberInterface
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
            KernelEvents::VIEW => ['assignOwner2Entity', EventPriorities::POST_WRITE],
        ];
    }

    public function assignOwner2Entity(ViewEvent $event): void
    {
        $record = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (Request::METHOD_POST !== $method || !is_object($record)) {
            return;
        }
        
        if (!$token = $this->tokenStorage->getToken()) {
            return;
        }
        
        if (!$token->isAuthenticated()) {
            return;
        }
        if (!$user = $token->getUser()) {
            return;
        }
        if(method_exists($record, 'setOwner')){
            $userId = $user->getUserid();
            $record->setOwner($userId);
            $this->entityManager->persist($record);
            $this->entityManager->flush();
            return;
        }
        if(!method_exists($record, 'setUserid') || !method_exists($record, 'getUserid') ){
            return;
        }
        $roles = $user->getRoles();
        $isAdmin = 0;
        if($roles && in_array('ROLE_ADMIN', $roles)){
            $isAdmin = 1;
        }
        $userId = $user->getUserid();
        if($userId){
            if(!$isAdmin || ($isAdmin && !$record->getUserid())){
                if(!method_exists($record, 'isStringUserid')){
                    $record->setUserid($user);
                }else{
                    $record->setUserid($userId);
                }
                $this->entityManager->persist($record);
                $this->entityManager->flush();
            }
        }
    }
}