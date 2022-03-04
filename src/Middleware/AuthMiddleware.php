<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;
use App\Libs\Security;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // if user has auth, use the request handler to continue to the next
        if (Security::isAuthenticated()) {
            return $handler->handle($request);
        }

        // if user does not have auth, possibly return a redirect response
        return new RedirectResponse('/security/signin');
    }
}