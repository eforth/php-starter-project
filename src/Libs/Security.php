<?php

namespace App\Libs;

use App\Service\userService;
use Exception;

class Security
{
	const PASSWORD_OPTS = [ 'cost' => 12 ];
	const USERID = 'userId';

	private UserService $userService;


	public static function isAuthenticated(): bool
	{
		return isset($_SESSION[self::USERID]);
	}

	public static function logout():void
	{
		unset($_SESSION[self::USERID]);
	}

	public function __construct()
	{
		$this->userService = new UserService;
	}

	private function setSessionUserId(int $userId): void
	{
		$_SESSION[self::USERID] = $userId;
	}

    /**
     * Authenticates the user given the email and password.
     * @param $email
     * @param $password
     * @throws Exception
     */
	function authenticate($email, $password): void
	{
	    
	    if (empty($username) || empty($password)) 
	    	throw new Exception("User credentials not provided.");

	    $hashed = password_hash($password, PASSWORD_DEFAULT, self::PASSWORD_OPTS);
	    $user = $this->userService->findByEmail($email);

	    if (!$user) 
	    	throw new Exception("User account not found.");

	    if ($user->getPassword() != $hashed) 
	    	throw new Exception("Username/Password is incorrect.");

	    $this->setSessionUserId($user->getId());
	}
}