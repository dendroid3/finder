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
     * Dispatch the request
     */
    public function dispatch($uri, $method) {
        $uri = parse_url($uri, PHP_URL_PATH);
        $method = strtoupper($method);

        if (!isset($this->routes[$method])) {
            $this->handleFallback($uri);
            return;
        }

        // Loop through all routes for this method
        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove full match
                $this->callAction($action, $matches);
                return;
            }
        }

        // No match → fallback
        $this->handleFallback($uri);
    }

    /**
     * Call route action with optional parameters
     */
    protected function callAction($action, $params = []) {
        if (is_callable($action)) {
            call_user_func_array($action, $params);
            return;
        }

        if (is_string($action)) {
            [$controller, $method] = explode('@', $action);

            $file = __DIR__ . '/../controllers/' . str_replace('\\', '/', $controller) . '.php';

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

            // Call method with dynamic parameters
            call_user_func_array([$obj, $method], $params);
            return;
        }
    }

    /**
     * Handle fallback route
     */
    protected function handleFallback($uri) {
        if ($this->fallback) {
            $this->callAction($this->fallback);
        } else {
            http_response_code(404);
            echo "Route not found: $uri";
        }
    }
}
