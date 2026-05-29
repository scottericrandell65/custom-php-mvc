<?php

class PostController extends Controller
{
	public function show($id): void
	{
		echo "Showing post: " . htmlspecialchars($id);
	}
}
