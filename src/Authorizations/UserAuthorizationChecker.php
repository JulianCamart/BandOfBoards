<?php

namespace App\Authorizations;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAuthorizationChecker
{
    private $methodsAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function check(UserInterface $user, string $method): void
    {
        $this->isAuthenticated();

        if($this->isMethodAllowed($method) && $user->getId() !== $this->user->getId()) {
            $error = "It's not you're ressource";
            throw new UnauthorizedHttpException($error, $error);
        }

    }

    public function isAuthenticated(): void
    {
        if (null === $this->user) {
            $error = "You are not authenticated";
            throw new UnauthorizedHttpException($error, $error);
        }
    }

    public function isMethodAllowed(string $method): bool
    {
        return in_array($method, $this->methodsAllowed, true);
    }
}
