<?php
namespace app;

class Router {
	private $routes = [];

	public function __construct($routes = []) {
		$this->routes = $routes;
	}

	public function add($path, $className, $method) {
		$this->routes[$path] = [$className, $method];
	}

	public function dispatch($uri): bool {
		$this->routes = array_reverse($this->routes, true);
		foreach ($this->routes as $path => $route) {
			$pattern = '#^'.str_replace('-','\-',$path).'#';
			if (preg_match($pattern, $uri, $matches)) {
				[$controllerName, $method] = $route;
				if (!class_exists($controllerName)) {
					die("Controller [$controllerName] not found");
				}
				$class = new $controllerName();
				if (!method_exists($class,$method)) {
					die("Method '$method' of [$controllerName] not exist");
				}
				$class->$method();
				return true;
			}
		}
		return false;

	}
}