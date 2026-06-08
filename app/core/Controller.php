<?php

class Controller
{
    /**
     * Store a flash message in session
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
	unset($_SESSION['flash'][$key]);
	
	return $message;
    }
    
    /**
     * MAIN VIEW RENDERER (now with context injection)
     */
    protected function view(string $view, array $data = []): void
    {
	// -----------------------------
	// AUTH CONTEXT (centralized)
	// -----------------------------
	$user = null;
	$isAuthenticated = false;
	$isAdmin = false;
	
	if (!empty($_SESSION['user_id'])) {
	    $user = [
		'id' => $_SESSION['user_id'],
		'name' => $_SESSION['user_name'] ?? null,
		'role' => $_SESSION['user_role'] ?? 'user',
	    ];
	    
	    $isAuthenticated = true;
	    $isAdmin = ($user['role'] === 'admin');
	}
	
	// -----------------------------
	// SHARED VIEW VARIABLES
	// -----------------------------
	$shared = [
	    'user' => $user,
	    'isAuthenticated' => $isAuthenticated,
	    'isAdmin' => $isAdmin,
	    'csrf_token' => $this->csrfToken(),
	];
	
	// Merge controller data + shared context
	$data = array_merge($shared, $data);
	
	extract($data);
	
	ob_start();
	
	require __DIR__ . '/../views/' . $view . '.php';
	
	$content = ob_get_clean();
	
	require __DIR__ . '/../views/layouts/main.php';
    }
    
    /**
     * CSRF token generator
     */
    protected function csrfToken(): string
    {
	if (empty($_SESSION['_token'])) {
	    $_SESSION['_token'] = bin2hex(random_bytes(32));
	}
	
	return $_SESSION['_token'];
    }
    
    /**
     * CSRF validation
     */
    protected function verifyCsrfToken(): void
    {
	$token = $_POST['_token'] ?? '';
	
	if (
	    empty($_SESSION['_token']) ||
	    !hash_equals($_SESSION['_token'], $token)
	) {
	    http_response_code(403);
	    die('Invalid CSRF token');
	}
    }
    
    /**
     * Auth checks
     */
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
    
    /**
     * Role-based admin check (clean RBAC)
     */
    protected function isAdmin(): bool
    {
	return ($_SESSION['user_role'] ?? 'user') === 'admin';
    }
    
    /**
     * Ownership check
     */
    public function isOwner(array $resource): bool
    {
	$userId = $_SESSION['user_id'] ?? null;
	
	if (!$userId || !isset($resource['user_id'])) {
	    return false;
	}
	
	return (int)$resource['user_id'] === (int)$userId;
    }
    
    /**
     * Generic authorization helper
     */
    protected function authorize(bool $condition, string $message = 'Forbidden'): void
    {
	if (!$condition) {
	    http_response_code(403);
	    die($message);
	}
    }
    
    protected function authorizeAdmin(): void
    {
	$this->authorize($this->isAdmin(), 'Admin access required.');
    }
    
    protected function authorizeOwner(array $resource): void
    {
	$this->authorize($this->isOwner($resource), 'You do not own this resource.');
    }
    
    protected function authorizeOwnerOrAdmin(array $resource): void
    {
	$this->authorize(
	    $this->isAdmin() || $this->isOwner($resource),
	    'Unauthorized action.'
	);
    }
}
