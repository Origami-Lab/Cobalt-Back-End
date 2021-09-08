<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class addTotalItems implements EventSubscriberInterface
{
    public function addTotalItems(ResponseEvent $event): void
    {
        $request = $event->getRequest();

        if (($data = $request->attributes->get('data')) && $data instanceof Paginator) {
            $totalItems = $data->getTotalItems();
            $response = $event->getResponse();
            $response->headers->add(['totalitems' => $totalItems]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'addTotalItems',
        ];
    }
}