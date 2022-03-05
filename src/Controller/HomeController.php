<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use App\Libs\View;

class HomeController
{
    /**
     * Controller.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $viewVariables = [
            'name' => 'Ervin Forth'
        ];

        $body = View::render('home.html', $viewVariables);

	    return new HtmlResponse($body);
    }
}