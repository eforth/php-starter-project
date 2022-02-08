<?php

/**
 * 
 */
class User
{
	public int $id;
	public string $username;
	public string $password;
	public string $firstName;

	function __construct($id, $username, $password, $firstName)
	{
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->firstName = $firstName;
	}
}