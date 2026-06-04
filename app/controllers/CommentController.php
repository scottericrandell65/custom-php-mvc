<?php

class CommentController extends Controller
{
	private CommentModel $commentModel;
	
	public function __construct()
	{
		$this->commentModel = new CommentModel();
	}
	
	/**
	 * Store a new comment
	 */
	public function store($postId): void
	{
		$this->requireAuth();
		$this->verifyCsrfToken();
		
		$validator = new Validator($_POST);
		
		$validator->required(['name', 'comment']);
		
		if ($validator->fails()) {
			$_SESSION['errors'] = $validator->errors();
			$_SESSION['old'] = $_POST;

			header("Location: /post/$postId");
			exit;
		}
		
		$this->commentModel->create(
			(int)$postId,
			trim($_POST['name']),
			trim($_POST['comment'])
		);
		
		$this->flash('success', 'Comment added successfully');
		
		header("Location: /post/$postId");
		exit;
	}
}
