<?php
namespace Controllers\api;

class AboutController
{
    public function get()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        $user_code = $_GET['user_code'] ?? null;
        if (!$user_code) {
            throw new \Exception("User code missing");
        }

        $stmt = $pdo->prepare("SELECT about FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($user);
    }
}
