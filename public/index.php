<?php

// This sends a persistent cookie that lasts a day.
session_start([
    'cookie_lifetime' => 86400,
]);

// Requires the autoloader for composer
require_once( dirname( __DIR__ ) . '/vendor/autoload.php' );

// Set constant ABSPATH to project root directory
define( 'ABSPATH', dirname( __DIR__ ) );

// Load the env variables from the .env file in the project root directory
(Dotenv\Dotenv::createImmutable( dirname( __DIR__ ) ) )->load();

(new App\Libs\Log())->getLogger()->info('App started');

// send the response to the browser
(new App\Libs\Route)->dispatch();