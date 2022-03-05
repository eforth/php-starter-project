<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use App\Libs\View;


class SecurityController {

	/**
     * Controller.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function getSignIn(ServerRequestInterface $request): ResponseInterface
    {
        $viewVariables = [];

        $body = View::render('signin.html', $viewVariables);

	    return new HtmlResponse($body);
    }
}