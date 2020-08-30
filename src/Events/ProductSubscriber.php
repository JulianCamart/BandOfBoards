<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Authorizations\ProductAuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ProductSubscriber implements EventSubscriberInterface
{

    private $methodsNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];

    private $productAuthorizationChecker;

    public function __construct(ProductAuthorizationChecker $productAuthorizationChecker)
    {
        $this->productAuthorizationChecker = $productAuthorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function check(ViewEvent $event): void
    {
        $product = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($product instanceof Product && !in_array($method, $this->methodsNotAllowed, true)) {
            $this->productAuthorizationChecker->check($product, $method);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}
