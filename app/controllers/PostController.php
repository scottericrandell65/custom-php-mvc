<?php

class PostController extends Controller
{
	private PostModel $postModel;

	public function __construct()
	{
	    $this->postModel = new PostModel();
	}

	public function show($id): void
	{
	    // Ask model instead of database directly
	    $post = $this->postModel->find((int)$id);

	   // Handle missing post
	   if (!$post) {
	       http_response_code(404);
	       echo "Post not found";
	       return;
	   }

	   // Load view
	   $this->view('posts/show', $post);
	}


	// Method Index
       public function index(): void
       {
	   // Show all posts
           $posts = $this->postModel->all();

              $this->view('posts/index', [
                  'title' => 'All Posts',
                  'posts' => $posts,
                  'success' => $this->getFlash('success'),
                  'token' => $this->csrfToken()
              ]);
        }

	public function create(): void
	{
	   $this->view('posts/create', [
	       'title' => 'Create Post',
	       'token' => $this->csrfToken()
	   ]);
	}

	public function store(): void
	{
	    // Protect against CSRF attacks
	    $this->verifyCsrfToken();

	   // Get and clean input
	   $title = trim($_POST['title'] ?? '');
	   $content = trim($_POST['content'] ?? '');

	   // Basic validation
	   if ($title === '' || $content === '') {
	      echo "Title and content are required.";
	      return;
	   }

	   // Delegate to model (clean architecture)
	   $this->postModel->create($title, $content);
	   $this->flash('success', 'Post created successfully');

	   // Redirect after success (Post/Redirect/GET pattern)
	   header("Location: /posts");
	   exit;
	}

	public function edit($id): void
	{
	    $post = $this->postModel->find((int)$id);

	    if (!$post) {
	        http_response_code(404);
		echo "Post not found";
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
	    // Protect against CSRF attacks
	    $this->verifyCsrfToken();

	    // Clean input
	    $title = trim($_POST['title'] ?? '');
	    $content = trim($_POST['content'] ?? '');

	    // Basic validation
	    if ($title === '' || $content === '') {
	    echo "Title and content are required.";
	    return;
	    }

	    // Delegate update logic to model
	    $this->postModel->update((int)$id, $title, $content);

	    // Redirect after successful update
	    header("Location: /posts");
	    exit;
	}

	public function delete($id): void
	{
	    // CSRF protection (prevents forged delete requests)
	    $this->verifyCsrfToken();

	    // Delegate deletion to model layer
	    $this->postModel->delete((int)$id);

	    // Redirect back to posts list
	    header("Location: /posts");
	    exit;
        }
}
