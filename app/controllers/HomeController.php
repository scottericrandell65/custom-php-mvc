<?php

class HomeController extends Controller
{
    public function index(): void
    {
	$data = [
	      'title' => 'Home',
	      'heading' => 'Home Page',
	      'message' => 'Welcome to my custom PHP OOP website.'
	];

	$this->view('home/index', $data);
    }

    public function about(): void
    {

	$data = [
	      'title' => 'About',
	      'heading' => 'About Page',
	      'message' => 'This website was built from scratch using PHP OOP.'
	];

	$this->view('home/about', $data);
    }

    public function contact(): void
    {

	$data = [
	    'title' => 'contact',
	    'heading' => 'Contact Page',
	    'message' => 'Send me a message below.',
	    'errors' => $_SESSION['errors'] ?? [],
	    'success' => $_SESSION['success'] ?? null
	];

	unset($_SESSION['errors'], $_SESSION['success']);

	$this->view('home/contact', $data);
    }

    public function contactSubmit(): void
    {

	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$message = trim($_POST['message'] ?? '');
	$errors = [];

	if ($name === '') {
	    $errors[] = "Your name is required";
	}
	if ($email === '') {
	    $errors[] = "Your Email is required";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $errors[] = "Your Email is not valid";
	}
	if ($message === '') {
	    $errors[] = "A message is required";
	}
	// If errors , then store and redirect back
	if (!empty($errors)) {
	    $_SESSION['errors'] = $errors;
	    header("Location: /contact");
	    exit;
	}

	// Success message
	$_SESSION['success'] = "Form submitted successfully!";
	header("Location: /contact");
	exit;
    }
}
