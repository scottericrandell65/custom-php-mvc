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

	public function get(string $path, $callback): void
	{
		$this->routes['GET'][$path] = $callback;
	}

	public function dispatch(): void
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		$callback = $this->routes[$method][$uri] ?? null;

		if (!$callback) {
		    http_response_code(404);
		    echo "404 - Page not found";
		    return;
		}

		// If callback is [Class, method]
		if (is_array($callback)) {
		   $class = $callback[0];
		   $method = $callback[1];

		$controller = new $class();
		   $controller->$method();
		   return;
		}

		// If callback is a function
		$callback();
	 }
}
