<?php

namespace App\Router;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $callback)
    {
        $this->routes[$method][$path] = $callback;
    }


    public function dispatch($uri, $method)
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

    private function findRoute($uri, $method)
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

    private function notFound()
    {
        include_once __DIR__ . '/../../public/views/404.php';
    }
}
