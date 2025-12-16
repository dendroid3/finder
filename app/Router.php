<?php

class Router {
    protected $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $method) {
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            if (is_callable($action)) {
                call_user_func($action);
                return;
            }

            if (is_string($action)) {
                [$controller, $controllerMethod] = explode('@', $action);

                $file = __DIR__ . '/../controllers/' . $controller . '.php';
                if (!file_exists($file)) {
                    die("Controller file $file not found!");
                }
                require_once $file;

                $fullController = "Controllers\\$controller";

                if (!class_exists($fullController)) {
                    die("Controller class $fullController not found!");
                }

                $obj = new $fullController;

                if (!method_exists($obj, $controllerMethod)) {
                    die("Method $controllerMethod not found in $fullController");
                }

                $obj->$controllerMethod();
                return;
            }
        }

        http_response_code(404);
        echo "Route not found: $uri";
    }
}
