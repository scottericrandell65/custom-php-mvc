<?php

  class PostModel
  {
	/**
	 * Database dependency
	 * This is injected so the model can run queries
	 */
	private Database $db;

	public function __construct()
	{
	    // Create DB connection once per model instance
	    $this->db = new Database();
	}

	/**
	 * Get all posts (latest first)
	 */
	public function all(): array
	{
	    return $this->db->fetchAll(
		"SELECT * FROM posts ORDER BY id DESC"
	    );
	}

	/**
	 * Find a single post by ID
	 */
	public function find(int $id): array|false
	{
	    return $this->db->fetch(
		"SELECT * FROM posts WHERE id = ?",
		[$id]
	    );
	}

	/**
	 * Create a new post
	 */
	public function create(string $title, string $content): bool
	{
	    return $this->db->execute(
		"INSERT INTO posts (title, content) VALUES (?, ?)",
		[$title, $content]
	    );
	}

	/**
	 * Update an existing post
	 */
	public function update(int $id, string $title, string $content): bool
	{
	    return $this->db->execute(
		"UPDATE posts SET title = ?, content = ? WHERE id = ?",
		[$title, $content, $id]
	    );
	}

	/**
	 * Delete a post
	 */
	public function delete(int $id): bool
	{
	    return $this->db->execute(
		"DELETE FROM posts WHERE id = ?",
		[$id]
	    );
	}
 }
