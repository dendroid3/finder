<?php
namespace Controllers;

class MainController
{
    public function index()
    {
        session_start();

        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $path = trim($path, '/');

        $user_code = explode('/', $path)[0];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!$user) {
            require_once __DIR__ . "/../views/404.html";
        }

        if ($_SESSION['user_id'] || $user['template_id'] == 3) {
            require_once __DIR__ . "/../views/templates/3/index.php";
        } else {
            $templateId = basename($user['template_id']);
            require_once __DIR__ . "/../views/templates/$templateId/index.html";
        }
    }
}