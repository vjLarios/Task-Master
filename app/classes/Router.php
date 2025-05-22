<?php
// app/classes/Router.php

class Router
{
    private $routes = [];

    public function add($method, $uri, $action)
    {
        $this->routes[] = compact('method','uri','action');
    }

    public function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                list($controller, $method) = explode('@', $route['action']);
                $controller = new $controller;
                return call_user_func_array([$controller, $method], []);
            }
        }

        // 404 si no hay coincidencia
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
    }
}
