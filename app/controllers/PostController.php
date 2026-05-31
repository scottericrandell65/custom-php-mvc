<?php

class PostController extends Controller
{
	public function show($id): void
	{
	    $db = new Database();

	    // Fetch single post safely using parameter binding
	    $post = $db->fetch(
		"SELECT * FROM posts WHERE id = ?",
		[(int)$id]
	    );

	    if (!$post) {
		http_response_code(404);
		echo "Post not found";
		return;
	    }

	    $this->view('posts/show', $post);
	}


	// Method Index
	public function index(): void
	{
	   // Create database connection
	   $db = new Database();

	   /**
	    * Fetch all posts from database
	    * ORDER BY id DESC = newest first
	    */
	   $posts = $db->fetchAll(
		"SELECT * FROM posts ORDER BY id DESC"
	   );

	   // Pass data to view
	   $this->view('posts/index', [
		'title' => 'All Posts',
		'posts' => $posts
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
	    $this->verifyCsrfToken();

	    $title = trim($_POST['title'] ?? '');
	    $content = trim($_POST['content'] ?? '');

	    if ($title === '' || $content === '') {
	        echo "Title and content are required.";
		return;
	    }

	    $db = new Database();

	    $db->execute(
	        "INSERT INTO posts (title, content) VALUES (?, ?)",
		[$title, $content]

	    );

	    header("Location: /posts");
	    exit;
	}

	public function edit($id): void
	{
	    $db = new Database();

	    $stmt = $db->query("SELECT * FROM posts WHERE id = " . (int)$id);
	    $post = $stmt->fetch(PDO::FETCH_ASSOC);

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
	    $this->verifyCsrfToken();
	    $title = trim($_POST['title'] ?? '');
	    $content = trim($_POST['content'] ?? '');

	    if ($title === '' || $content === '') {
		echo "Title and content are required.";
		return;
	   }

	   $db = new Database();

	   $db->execute(
		"UPDATE posts
		 SET title = ?, content = ?
		 WHERE id = ?",
		[$title, $content, (int)$id]
	   );

	   header("Location: /posts");
	   exit;
	}

	public function delete($id): void
	{
	   $this->verifyCsrfToken();

	   $db = new Database();

	   $db->execute(
		"DELETE FROM posts WHERE id = ?",
		[(int)$id]
	   );

	   header("Location: /posts");
	   exit;

   }
}
