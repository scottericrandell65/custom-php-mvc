<?php

class CommentModel
{
	private Database $db;
	
	public function __construct()
	{
		$this->db = new Database();
	}
	
	/**
	 * Save a comment for a post
	 */
	public function create(int $postId, string $name, string $comment): bool
	{
		return $this->db->execute(
			"INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)",
			[$postId, $name, $comment]
		);
	}
	
	/**
	 * Get all comments for a post
	 */
	public function getByPostId(int $postId): array
	{
		return $this->db->fetchAll(
			"SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC",
			[$postId]
		);
	}
}
