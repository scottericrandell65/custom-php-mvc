<?php

class PostController extends Controller
{
	public function show($id): void
	{
	    $db = new Database();

	    $stmt = $db->query("SELECT * FROM posts WHERE id = " . (int)$id);
	    $post = $stmt->fetch(PDO::FETCH_ASSOC);

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

	   $db = new Database();

	   $stmt = $db->query("SELECT * FROM posts ORDER BY id DESC");
	   $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

	    $stmt = $db->query(
	        "INSERT INTO posts (title, content)
	         VALUES ('" . addslashes($title) . "', '" . addslashes($content) . "')"
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

	   $db->query("
	       UPDATE posts
	       SET title = '" . addslashes($title) . "',
		   content = '" . addslashes($content) . "'
	       WHERE id = " . (int)$id
	   );

	   header("Location: /posts");
	   exit;
	}

	public function delete($id): void
	{
	   $this->verifyCsrfToken();

	   $db = new Database();

	   $db->query("DELETE FROM posts WHERE id =" . (int)$id);

	   header("Location: /posts");
	   exit;

   }
}
