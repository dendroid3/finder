<?php
namespace Controllers;

class LoginController
{
    public function create()
    {
        $message = "Welcome to my PHP MVC!";
        require_once __DIR__ . '/../views/login.php';
    }

    public function store()
    {
        session_start();
        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (!$email || !$password) {
            die("Email and password required");
        }

        // Fetch user
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            die("Invalid credentials");
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            die("Invalid credentials");
        }

        // Login success
        $_SESSION['user_id'] = $user['id'];

        header("Location: /login");
        exit;

    }
}
