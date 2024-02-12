<?php

namespace App\Router;

class Router
{
    public function __construct()
    {
        $this->initRoutes();
    }

    public array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);
        if (!$route) {
            $this->notFound();
        }

        $route->getAction()();
    }

    private function notFound()
    {
        echo "404 Not Found";
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/src/config/routes.php';
    }
}
