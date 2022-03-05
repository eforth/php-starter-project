<?php

namespace App\Service;

use App\Libs\DB;
use App\Model\User;
use PDO;


class UserService {

	private ?PDO $pdo;


	public function __construct()
	{
		$this->pdo = (new DB())->getPDO();
	}

	public function save($user) 
	{
		if ($user->getId()) {
			return $this->update($user);
		}
		
		return $this->insert($user);
	}

	public function insert($user) 
	{
		$sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(1, $user->getFirstName(), PDO::PARAM_STR);
		$stmt->bindValue(2, $user->getLastName(), PDO::PARAM_STR);
		$stmt->bindValue(3, $user->getEmail(), PDO::PARAM_STR);
		$stmt->bindValue(4, $user->getPassword(), PDO::PARAM_STR);

		return $stmt->execute();
	}

	public function update($user) 
	{
		$sql = 'UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?';
		
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(1, $user->getFirstName(), PDO::PARAM_STR);
		$stmt->bindValue(2, $user->getLastName(), PDO::PARAM_STR);
		$stmt->bindValue(3, $user->getEmail(), PDO::PARAM_STR);
		$stmt->bindValue(4, $user->getId(), PDO::PARAM_INT);

		return $stmt->execute();
	}

	public function findById($id): ?User
    {
		$sql = 'SELECT * FROM users WHERE id = ?';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);

		if (!$stmt->execute()) return null;

		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return User::toUser($data);
	}

	public function findByEmail($email) 
	{
		$sql = 'SELECT * FROM users WHERE email = ?';
		
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(1, $email, PDO::PARAM_STR);

		if (!$stmt->execute()) return null;

		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return User::toUser($data);
	}

	public function findAll(): array
    {
		$users = [];
		$sql = 'SELECT * FROM users';
		
		$stmt = $this->pdo->prepare($sql);

		if (!$stmt->execute()) return $users;

		$results = $stmt->fetchAll();

		foreach ($results as $result) {
			$user = User::toUser($result);
			$users[] = $user;
		}

		return $users;
	}
}