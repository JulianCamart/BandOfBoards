<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Product;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CurrentUserForProductsSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['currentUserForProducts', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function currentUserForProducts(ViewEvent $event): void
    {
        $product = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($product instanceof Product && Request::METHOD_POST === $method) {
            $product->setVendor($this->security->getUser());
        }
    }
}