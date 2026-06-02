<?php

	class AuthController extends Controller
	{
		private UserModel $userModel;
		
		public function __construct()
		{
			$this->userModel = new UserModel();
		}
		
		public function login(): void
		{
			$this->view('auth/login', [
				'title' => 'Login',
				'token' => $this->csrfToken(),
				'errors' => $_SESSION['errors'] ?? [],
				'old' => $_SESSION['old'] ?? [],
				'success' => $this->getFlash('success')
			]);
			
			unset($_SESSION['errors'], $_SESSION['old']);
		}
		
		public function authenticate(): void
		{
			$this->verifyCsrfToken();
			
			$validator = new Validator($_POST);
			
			$validator
				->required(['email', 'password'])
				->email('email');
				
			if ($validator->fails()) {
				$_SESSION['errors'] = $validator->errors();
				$_SESSION['old'] = $_POST;
				
				header('Location: /login');
				exit;
			}
			
			if (
				!user ||
				!$this->userModel->verifyPassword(
					$_POST['password'],
					$user['password']
				)
			) {
				$_SESSION['errors'] = [
					'email' => 'Invalid credentials.'
				];
				
				$_SESSION['old'] = [
					'email' => $_POST['email']
				];
				
				header('Location: /login');
				exit;
			  }
			  
	 		  $_SESSION['user_id'] = $user['id'];
			  $_SESSION['user_name'] = $user['name'];
			  
			  $this->flash('success', 'Logged in successfully.');
			  
			  header('Location: /');
			  exit;
		}
		
		public function logout(): void
		{
			unset(
				$_SESSION['user_id'],
				$_SESSION['user_name']
			);
			
			$this->flash('success', 'Logged out successfully.');
			
			header('Location: /');
			exit;
		}
	}
		  
