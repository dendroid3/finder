<?php

class Router {
    protected $routes = [];
    protected $fallback;

    /**
     * Register a GET route
     */
    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    /**
     * Register a POST route
     */
    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    /**
     * Set a fallback route
     */
    public function fallback($action) {
        $this->fallback = $action;
    }

    /**
     * Dispatch the route
     */
    public function dispatch($uri, $method) {
        // Remove query string from URI
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $this->callAction($this->routes[$method][$uri]);
            return;
        }

        // If no route found, check fallback
        if ($this->fallback) {
            $this->callAction($this->fallback);
            return;
        }

        // No route and no fallback → 404
        http_response_code(404);
        echo "Route not found: $uri";
    }

    /**
     * Call a route action (closure or controller)
     */
    protected function callAction($action) {
        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        if (is_string($action)) {
            [$controller, $method] = explode('@', $action);

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
            if (!method_exists($obj, $method)) {
                die("Method $method not found in $fullController");
            }

            $obj->$method();
            return;
        }
    }
}
