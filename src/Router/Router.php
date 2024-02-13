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
            return; // добавляем return, чтобы прекратить выполнение метода, если маршрут не найден
        }

        $action = $route->getAction(); // сохраняем действие маршрута

        if ($action && is_callable($action)) { // добавляем проверку на существование и вызываемость действия
            $action();
        } else {
            $this->notFound();
        }
    }


    private function notFound()
    {
        require_once __DIR__ . "/../../public/views/pages/404.php";
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
        return require __DIR__ . '/../config/routes.php';
    }
}
