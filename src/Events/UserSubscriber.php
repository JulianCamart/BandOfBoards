<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Authorizations\UserAuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;

class UserSubscriber implements EventSubscriberInterface
{

    private $methodsNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];

    private $userAuthorizationChecker;

    public function __construct(UserAuthorizationChecker $userAuthorizationChecker)
    {
        $this->userAuthorizationChecker = $userAuthorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function check(ViewEvent $event): void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($user instanceof User && !in_array($method, $this->methodsNotAllowed, true)) {
            $this->productAuthorizationChecker->check($user, $method);
            $user->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}
