<?php

	class AuthController extends Controller
	{
		private UserModel $userModel;
		
		public function __construct()
		{
			$this->userModel = new UserModel();
		}
		
		public function register(): void
		{
			$this->view('auth/register', [
				'title' => 'Register',
				'token' => $this->csrfToken(),
				'errors' => $_SESSION['errors'] ?? [],
				'old' => $_SESSION['old'] ?? []
			]);
			
			unset($_SESSION['errors'], $_SESSION['old']);
		}
		
		public function store(): void
		{
			$this->verifyCsrfToken();
			
			$validator = new Validator($_POST);
			
			$validator
				->required(['name', 'email', 'password'])
				->email('email')
				->min('password', 6);
				
			if ($validator->fails()) {
				$_SESSION['errors'] = $validator->errors();
				$_SESSION['old'] = $_POST;
				
				header('Location: /register');
				exit;
			}
			
			// Check if email already exists
			$existingUser = $this->userModel->findByEmail(trim($_POST['email']));
			
			if ($existingUser) {
				$_SESSION['errors'] = [
					'email' => 'Email already in use.'
				];
				
				$_SESSION['old'] = $_POST;
				
				header('Location: /register');
				exit;
			}
			
			// Create user
			$this->userModel->create(
				trim($_POST['name']),
				trim($_POST['email']),
				$_POST['password']
			);
			
			// Auto-login (IMPORTANT PART YOU REQUESTED)
			$user = $this->userModel->findByEmail(trim($_POST['email']));
			
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['user_name'] = $user['name'];
			
			$this->flash('success', 'Account created successfully.');
			
			header('Location: /');
			exit;
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
			
			$user = $this->userModel->findByEmail(
				trim($_POST['email'])
			);
			
			if (
				!$user ||
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
		  
