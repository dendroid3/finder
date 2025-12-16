<?php
namespace Controllers;

class RegistrationController {
    public function create() {
        $message = "Welcome to my PHP MVC!";
        require_once __DIR__ . '/../views/register.php';
    }
}
