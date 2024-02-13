<?php

namespace App\Router;

class Router
{
    private array $routes = [];

    public function addRoute(string $method, string $path, mixed $callback): void
    {
        $this->routes[$method][$path] = $callback;
    }

    public function dispatch(string $uri, string $method): void
    {
        $callback = $this->findRoute($uri, $method);

        if ($callback === false) {
            $this->notFound();
            return;
        }

        if (is_string($callback)) {
            include_once __DIR__ . '/../../public/' . $callback;
            return;
        }

        $callback();
    }

    private function findRoute(string $uri, string $method): mixed
    {
        if (!isset($this->routes[$method])) {
            return false;
        }

        foreach ($this->routes[$method] as $route => $callback) {
            if ($uri === $route) {
                return $callback;
            }
        }

        return false;
    }

    private function notFound(): void
    {
        include_once __DIR__ . '/../../public/views/404.php';
    }
}
