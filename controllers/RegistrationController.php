<?php
namespace Controllers;

class RegistrationController
{
    public function create()
    {
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
        $password = $_POST['password'] ?? '';

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!isset($_FILES['profilePic'])) {
            die("No file uploaded");
        }

        $uploadDir = __DIR__ . '/../storage/profile_pictures/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = $_FILES['profilePic'];

        // Validate image
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            die("Invalid image type");
        }

        // Generate safe filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_', true) . '.' . $extension;

        $destination = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo "Image saved successfully: " . $filename;
        } else {
            echo "Failed to save image";
        }

        try {
            // 1. Connect to the database (adjust credentials)
            $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("
                INSERT INTO users 
                (name, code, phone_number, email, title, subtitle, profile_picture_url, password)
                VALUES 
                (:name, :code, :phone_number, :email, :title, :subtitle, :profile_picture_url, :password)
            ");

            $stmt->execute([
                ':name' => $name,
                ':code' => strtoupper($this->generateRandomString()),
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':title' => $title,
                ':subtitle' => $subtitle,
                ':profile_picture_url' => $filename,
                ':password' => $hashedPassword
            ]);

            // header('Location: /login');
            exit;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charactersLength - 1);
            $randomString .= $characters[$randomIndex];
        }
        return $randomString;
    }

}
