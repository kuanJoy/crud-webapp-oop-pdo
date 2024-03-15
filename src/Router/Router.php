<?php

namespace App\Router;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $callback)
    {
        $this->routes[$method][$path] = $callback;
    }

    private function handleRouteWithId($callback, $id)
    {
        $callback($id);
    }

    public function dispatch($uri, $method)
    {
        $route = $this->findRoute($uri, $method);

        if ($route === false) {
            $this->notFound();
            return;
        }

        if (is_array($route)) {
            $callback = $route[0];
            $id = $route[1];
            $this->handleRouteWithId($callback, $id);
            return;
        }

        if (is_string($route)) {
            include_once __DIR__ . '/../../public/' . $route;
            return;
        }

        $route();
    }

    private function findRoute($uri, $method)
    {
        $queryString = strpos($uri, '?');
        if ($queryString !== false) {
            $uri = substr($uri, 0, $queryString);
        }

        if (!isset($this->routes[$method])) {
            return false;
        }

        foreach ($this->routes[$method] as $route => $callback) {
            if (strpos($route, '{id}') !== false) {
                $pattern = str_replace('{id}', '(.+)', $route); // Changed to match any characters
                if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                    $id = $matches[1];
                    return [$callback, $id];
                }
            } elseif ($uri === $route) {
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
