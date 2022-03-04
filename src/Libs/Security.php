<?php

namespace App\Libs;

use App\Service\userService;

class Security
{
	const PASSWORD_OPTS = [ 'cost' => 12 ];
	const USERID = 'userId';

	private $userService;


	public static function isAuthenticated()
	{
		return isset($_SESSION[self::USERID]);
	}

	public static function logout()
	{
		unset($_SESSION[self::USERID]);
	}

	public function __construct()
	{
		$this->service = new UserService();
	}

	private function setSessionUserId($userId)
	{
		$_SESSION[self::USERID] = $userId;
	}

	/**
	 * Authenticates the user given the username and password from the login form.
	 * @param $username
	 * @param $password
	 */
	function authenticate($email, $password) 
	{
	    
	    if (empty($username) || empty($password)) 
	    	throw new Exception("User credentials not provided.");

	    $hashed = password_hash($password, PASSWORD_DEFAULT, self::PASSWORD_OPTS);
	    $user = $this->service->findByEmail($email);

	    if (!$user) 
	    	throw new Exception("User account not found.");

	    if ($user->getPassword() != $hashed) 
	    	throw new Exception("Username/Password is incorrect.");

	    $this->setSessionUserId($user->getId());
	}
}