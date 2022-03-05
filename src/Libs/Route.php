<?php

namespace App\Libs;

use App\Controller\HomeController;
use App\Middleware\AuthMiddleware;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

class Route {

	private Router $router;
	private ServerRequest $request;
	private SapiEmitter $emitter;

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

	public function dispatch()
	{
		$this->mapRoutes();
		$response = $this->router->dispatch($this->request);
		$this->emitter->emit($response);
	}
}