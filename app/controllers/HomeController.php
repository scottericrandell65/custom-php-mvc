<?php

class HomeController extends Controller
{
    public function index(): void
    {
	$data = [
	      'title' => 'Home',
	      'heading' => 'Home Page',
	      'message' => 'Welcome to my custom PHHP OOP website.'
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
	      'title' => 'Contact',
	      'heading' => 'Contact Page',
	      'message' => 'Send me a message below.'
	];

	$this->view('home/contact', $data);
    }
}
