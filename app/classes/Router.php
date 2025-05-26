<?php
// app/classes/Router.php

class Router
{
    private $routes = [];

    public function add(string $method, string $uri, string $action)
    {
        $this->routes[] = compact('method','uri','action');
    }

    public function dispatch()
    {
        // Obtiene la ruta solicitada sin slash inicial/final
        $requestPath   = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            // Normaliza la URI de la ruta (quita slashes)
            $routeUri = trim($route['uri'], '/');

            // Convierte segmentos {nombre} en grupos con nombre (?P<nombre>[^/]+)
            $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $routeUri);
            // Delimita para hacer match exacto
            $pattern = "#^{$pattern}$#";

            // Comprueba método y patrón
            if ($route['method'] === $requestMethod && preg_match($pattern, $requestPath, $matches)) {
                // Extrae sólo los parámetros con clave de texto
                $params = [];
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }

                // Invoca controlador@metodo con $params
                list($controllerName, $method) = explode('@', $route['action']);
                $controller = new $controllerName;
                return call_user_func_array([$controller, $method], [$params]);
            }
        }

        // Si no encontró ruta, 404
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
        exit;
    }
}
