<?php

namespace App\Libs;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {

	private Logger $logger;

	public function __construct() 
	{
		
		$this->logger = new Logger($_ENV['LOG_CHANNEL']);

		$log_path = ABSPATH . '/logs/app.log';

		$handler = new StreamHandler($log_path, Logger::DEBUG);

		$this->logger->pushHandler($handler);
	}

	public function getLogger(): Logger
    {
		return $this->logger;
	}

}