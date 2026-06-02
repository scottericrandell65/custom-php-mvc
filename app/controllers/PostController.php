<?php

class PostController extends Controller
{
    private PostModel $postModel;
    
    public function __construct()
    {
	$this->postModel = new PostModel();
    }
    
    public function index(): void
    {
	$posts = $this->postModel->all();
	
	$this->view('posts/index', [
	    'title' => 'All Posts',
	    'posts' => $posts,
	    'success' => $this->getFlash('success'),
	    'token' => $this->csrfToken()
	]);
    }
    
    public function show($id): void
    {
	$post = $this->postModel->find((int)$id);
	
	if (!$post) {
	    http_response_code(404);
	    $this->view('errors/404');
	    return;
	}
	
	$this->view('posts/show', [
	    'title' => $post['title'],
	    'content' => $post['content']
	]);
    }
    
    public function create(): void
    {
	$this->view('posts/create', [
	    'title' => 'Create Post',
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
	
	$validator->required(['title', 'content']);
	
	if ($validator->fails()) {
	    
	    $_SESSION['errors'] = $validator->errors();
	    $_SESSION['old'] = $_POST;
	    
	    header("Location: /posts/create");
	    exit;
	}
	
	$this->postModel->create(
	    trim($_POST['title']),
	    trim($_POST['content'])
	);
	
	$this->flash('success', 'Post created successfully');
	
	header("Location: /posts");
	exit;
    }
    
    public function edit($id): void
    {
	$post = $this->postModel->find((int)$id);
	
	if (!$post) {
	    http_response_code(404);
	    $this->view('errors/404');
	    return;
	}
	
	$this->view('posts/edit', [
	    'title' => 'Edit Post',
	    'post' => $post,
	    'token' => $this->csrfToken()
	]);
    }
    
    public function update($id): void
    {
	$this->verifyCsrfToken();
	
	$validator = new Validator($_POST);
	
	$validator->required(['title', 'content']);
	
	if ($validator->fails()) {
	    
	    $_SESSION['errors'] = $validator->errors();
	    $_SESSION['old'] = $_POST;
	    
	    header("Location: /posts/edit/$id");
	    exit;
	}
	
	$this->postModel->update(
	    (int)$id,
	    trim($_POST['title']),
	    trim($_POST['content'])
	);
	
	$this->flash('success', 'Post updated successfully');
	
	header("Location: /posts");
	exit;
    }
    
    public function delete($id): void
    {
	$this->verifyCsrfToken();
	
	$this->postModel->delete((int)$id);
	
	$this->flash('success', 'Post deleted successfully');
	
	header("Location: /posts");
	exit;
    }
}
