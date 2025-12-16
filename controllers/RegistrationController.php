<?php
namespace Controllers;

class RegistrationController {
    public function create() {
        $message = "Welcome to my PHP MVC!";
        require_once __DIR__ . '/../views/register.php';
    }
    
    public function store()
    {
        // Example: Get POST data (sanitize as needed)
        $name = $_POST['name'] ?? '';
        $phone_number = $_POST['phone_number'] ?? '';
        $email = $_POST['email'] ?? '';
        $title = $_POST['title'] ?? '';
        $subtitle = $_POST['subtitle'] ?? '';
        $profile_picture_url = $_POST['profile_picture_url'] ?? '';
        $password = $_POST['password'] ?? '';

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            // 1. Connect to the database (adjust credentials)
            $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', '');
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("
                INSERT INTO users 
                (name, code, phone_number, email, title, subtitle, profile_picture_url, password)
                VALUES 
                (:name, :code, :phone_number, :email, :title, :subtitle, :profile_picture_url, :password)
            ");

            $stmt->execute([
                ':name' => $name,
                ':code' => strtoupper($this -> generateRandomString()),
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':title' => $title,
                ':subtitle' => $subtitle,
                ':profile_picture_url' => $profile_picture_url,
                ':password' => $hashedPassword
            ]);

            echo "User successfully registered!";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charactersLength - 1); // cryptographically secure
            $randomString .= $characters[$randomIndex];
        }
        return $randomString;
    }

}
