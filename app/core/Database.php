<?php

class Database
{
	private PDO $pdo;

	public function __construct()
	{
	    $config = require __DIR__ . '/../../config/database.php';

	    $dsn = sprintf(
		'mysql:host=%s;dbname=%s;charset=utf8mb4',
		$config['host'],
		$config['dbname']
	   );

	   try {

	       $this->pdo = new PDO(
		   $dsn,
		   $config['username'],
		   $config['password']
	       );

	       $this->pdo->setAttribute(
		   PDO::ATTR_ERRMODE,
		   PDO::ERRMODE_EXCEPTION
	       );
	   } catch (PDOException $e) {

	       die($e->getMessage());
	}
}
	public function query(string $sql): PDOStatement
	{
		return $this->pdo->query($sql);
	}
}
