<?php
namespace Controllers;

class HomeController {
    public function index() {
        $message = "Welcome to my PHP MVC!";
        require_once __DIR__ . '/../views/index.php';
    }
}
