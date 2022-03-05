<?php

namespace App\Libs;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class View {

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public static function render($view, $params): string
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