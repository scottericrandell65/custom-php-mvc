<?php

	class UserModel
	{
		private Database $db;
		
		public function __construct()
		{
			$this->db = new Database();
		}
		
		/**
		 * Create a new user (registration)
		 */
		public function create(string $name, string $email, string $password): bool
		{
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			
			return $this->db->execute(
				"INSERT INTO users (name, email, password) VALUES (?, ?, ?)",
				[$name, $email, $hashedPassword]
			);
		}
		
		/**
		 * Find user by email (login lookup)
		 */
		public function findByEmail(string $email): array|false
		{
			return $this->db->fetch(
				"SELECT * FROM users WHERE email = ?",
				[$email]
			);
		}
		
		/**
		 * Verify password during login
		 */
		public function verifyPassword(string $plainPassword, string $hashedPassword): bool
		{
			return password_verify($plainPassword, $hashedPassword);
		}
	}
