<?php

class Controller
{
    /**
     * Store a flash message in session
     * Will persist only for next request
     */
    protected function flash(string $key, string $message): void
    {
	$_SESSION['flash'][$key] = $message;
    }

    /**
     * Retrieve and remove flash message
     */
    protected function getFlash(string $key): ?string
    {
	if (!isset($_SESSION['flash'][$key])) {
	    return null;
	}

	$message = $_SESSION['flash'][$key];

	// Important: remove after reading (one-time display)
	unset($_SESSION['flash'][$key]);

	return $message;
    }

    protected function view(string $view, array $data = []): void
	{
	   extract($data);

	   ob_start();

	   require __DIR__ . '/../views/' . $view . '.php';

		$content = ob_get_clean();

		require __DIR__ . '/../views/layouts/main.php';
	}

    protected function csrfToken(): string
	{
	  if (empty($_SESSION['_token'])) {
	      $_SESSION['_token'] = bin2hex(random_bytes(32));
	  }

	  return $_SESSION['_token'];
	}

    protected function verifyCsrfToken(): void
        {
	  $token = $_POST['_token'] ?? '';

	  if (
	     empty($_SESSION['_token']) || !hash_equals($_SESSION['_token'], $token)
	  ) {
	      http_response_code(403);
	      die('Invalid CSRF token');
	    }
        }
	
	protected function isAuthenticated(): bool
	{
	    return isset($_SESSION['user_id']);
	}
	
	protected function requireAuth(): void
	{
	    if (!$this->isAuthenticated()) {
		$this->flash('error', 'Please log in to continue.');
		
		header('Location: /login');
		exit;
	    }
	}
	
	protected function guestOnly(): void
	{
	    if ($this->isAuthenticated()) {
		header('Location: /');
		exit;
	    }
	}
	
	// Simple (for now), restrict post creation to owner
	protected function isAdmin(): bool
	{
	    return isset($_SESSION['user_email'])
		&& $_SESSION['user_email'] === 'you@example.com';
	}
	
	// Reusable ownership check
	public function isOwner(array $resource): bool
	{
	    return isset($resource['user_id'], $_SESSION['user_id'])
		&& (int)$resource['user_id'] === (int)$_SESSION['user_id'];
	}
}
