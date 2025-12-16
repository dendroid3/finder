<?php
namespace Controllers;

class LoginController {
    public function create() {
        $message = "Welcome to my PHP MVC!";
        require_once __DIR__ . '/../views/login.php';
    }
}
