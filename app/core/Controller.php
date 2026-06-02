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
}
