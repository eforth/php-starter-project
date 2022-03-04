<?php

namespace App\Libs;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\ServerRequestFactory;
use App\Controller\HomeController;
use App\Middleware\AuthMiddleware;

class Route {

	private $router;
	private $request;
	private $emitter;

	public function __construct()
	{
		$this->request = ServerRequestFactory::fromGlobals(
		    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
		);

		$this->router = new Router;
		$this->emitter = new SapiEmitter;

	}

	private function mapRoutes()
	{
		$this->router->get('/', HomeController::class)
			->middleware(new AuthMiddleware);
		$this->router->get('/security/signin', 
			'App\Controller\SecurityController::getSignIn');
	}

	public function getRouter()
	{
		return $this->router;
	}

	public function dispatch()
	{
		$this->mapRoutes();
		$response = $this->router->dispatch($this->request);
		$this->emitter->emit($response);
	}
}