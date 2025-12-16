<?php

require_once __DIR__ . '/Router.php';

class App {
    protected $router;
    protected $basePath;

    public function __construct() {
        $this->router = new Router();

        // Automatically detect base path (your folder in localhost)
        $this->basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(__DIR__ . '/../public'));
    }

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];

        // Remove query string
        $uri = parse_url($uri, PHP_URL_PATH);

        // Remove script name (/index.php) if present
        $uri = str_replace('/index.php', '', $uri);

        // Detect the base folder dynamically
        $baseFolder = dirname($_SERVER['SCRIPT_NAME']); // e.g., /finder/public
        if ($baseFolder !== '/' && strpos($uri, $baseFolder) === 0) {
            $uri = substr($uri, strlen($baseFolder));
        }

        // Default to root
        if ($uri === '' || $uri === false) {
            $uri = '/';
        }

        $this->router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
    }


    public function getRouter() {
        return $this->router;
    }
}
