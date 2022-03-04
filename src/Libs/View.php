<?php

namespace App\Libs;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class View {

	public static function render($view, $params)
	{
		$shouldAutoLoad = boolval($_ENV['DEBUG']);
		$templatesDir = ABSPATH . '/templates';
		$cacheDir = ABSPATH . '/cache';
		$loader = new FilesystemLoader($templatesDir);
		$twig = new Environment($loader, [
		    'cache' => $cacheDir,
		    'auto_reload' => $shouldAutoLoad
		]);

		return $twig->render($view, $params);
	}
}