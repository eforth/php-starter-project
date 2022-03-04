<?php

namespace App\Model;

class User {

	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $password;

	public function __construct($id, $firstName, $lastName, $email, $password) {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password;
	}

	public static function fromAssocArray($data) {

		if (empty($data)) return null;

		return new User($data['id'], $data['first_name'], $data['last_name'],
			$data['email'], $data['password']
		);
	}
}