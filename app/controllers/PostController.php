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
}
