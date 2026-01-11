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

        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            die("Email and password required");
        }

        // Fetch user (include code!)
        $stmt = $pdo->prepare(
            "SELECT id, code, password FROM users WHERE email = ?"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            die("Invalid credentials");
        }

        // Login success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_code'] = $user['code'];

        // Build redirect URL: protocol://host/{code}
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https'
            : 'http';

        $host = $_SERVER['HTTP_HOST'];

        header("Location: {$protocol}://{$host}/{$user['code']}");
        exit;
    }


    public function logout()
    {
        session_start();

        // Clear session variables
        $_SESSION = [];

        // Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("Location: login");
        exit;

    }


}
