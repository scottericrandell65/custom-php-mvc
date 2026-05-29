<?php
/*
|----------------------------------------------
-----------------------------------------------
-
| Project: My PHP OOP Website
| Author: Scott Randell
| Purpose: Router System
| Created: 05-27-2026
|----------------------------------------------
-----------------------------------------------
-
*/

class Router
{
	private array $routes = [];
	private array $params = [];

	public function get(string $path, $callback): void
	{
		$this->routes['GET'][$path] = $callback;
	}

	public function post(string $path, $callback): void
	{
	        $this->routes['POST'][$path] = $callback;
	}

	public function dispatch(): void
	{
                $method = $_SERVER['REQUEST_METHOD'];
	        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	       foreach ($this->routes[$method] ?? [] as $path => $callback) {
		      $pattern = $this->convertPathToRegex($path);

		      if (preg_match($pattern, $uri, $matches)) {
		        array_shift($matches);
			  $this->params = $matches;
		     $this->runCallback($callback);
		     return;
	}
    }
	http_response_code(404);
	echo "404 - Page not found";
}

	private function convertPathToRegex(string $path): string
	{
		$pattern = preg_replace('/\{[a-zA-Z]+\}/', '([^/]+)', $path);
		return '#^' . $pattern . '$#';
	}

	private function runCallback($callback): void
	{
		// Controller callback
		if (is_array($callback)) {

		$class = $callback[0];

		$method = $callback[1];

		$controller = new $class();

		call_user_func_array(
		    [$controller, $method],
		    $this->params
		);

		return;
	}

	// Function callback
	call_user_func_array(
	    $callback,
	    $this->params
	);
     }
}

