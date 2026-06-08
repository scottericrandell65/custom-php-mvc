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
	public function create(int $postId, int $userId, string $comment): bool
	{
		return $this->db->execute(
			"INSERT INTO comments (post_id, name, comment, user_id)
			VALUES (?, ?, ?, ?)",
			[
				$postId,
				// system-controlled identity name (not user input)
				$this->getUserName($userId),
				$comment,
				$userId
			]
		);
	}
	
	private function getUserName(int $userId): string
	{
		$db = new Database();
		$user = $db->fetch("SELECT name FROM users WHERE id = ?", [$userId]);
		
		return $user['name'] ?? 'User';
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
	
	/**
	 * Find single comment (needed for RBAC)
	 */
	public function find(int $id): array|false
	{
		return $this->db->fetch(
			"SELECT * FROM comments WHERE id = ?",
			[$id]
		);
	}
	
	/**
	 * Update comment (future RBAC use)
	 */
	public function update(int $id, string $comment): bool
	{
		return $this->db->execute(
			"UPDATE comments SET comment = ? WHERE id = ?",
			[$comment, $id]
		);
	}
	
	/**
	 * Delete comment
	 */
	public function delete(int $id): bool
	{
		return $this->db->execute(
			"DELETE FROM comments WHERE id = ?",
			[$id]
		);
	}
}
