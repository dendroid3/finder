<?php
namespace Controllers\api;

class ServicesController
{
    public function store()
    {
        session_start();

        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        $input = json_decode(file_get_contents('php://input'), true);
        $title = $input['title'] ?? null;
        $description = $input['description'] ?? null;
        $user_code = $input['user_code'] ?? null;

        $stmt = $pdo->prepare("SELECT id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user_id = $user['id'];
        if (!$title || !$description) {
            throw new \Exception("Title and description required");
        }

        // Insert
        $stmt = $pdo->prepare(
            "INSERT INTO service_user (user_id, title, description)
         VALUES (?, ?, ?)"
        );

        $stmt->execute([
            $user_id,
            $title,
            $description
        ]);

        // Success response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'service_user_id' => $pdo->lastInsertId()
        ]);
    }

    public function get()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        $user_code = $_GET['user_code'] ?? null;
        if (!$user_code) {
            throw new \Exception("User code missing");
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user_id = $user['id'];
        $stmt = $pdo->prepare("SELECT * FROM service_user WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $services = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($services);
    }

    public function delete()
    {
        session_start();

        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        // Read raw input (JSON)
        $input = json_decode(file_get_contents('php://input'), true);

        // Fallback for form-encoded
        if (!is_array($input)) {
            parse_str(file_get_contents('php://input'), $input);
        }

        $service_id = $input['service_id'] ?? $_GET['service_id'] ?? null;

        if (!$service_id) {
            http_response_code(400);
            echo json_encode(['error' => 'service_id missing']);
            return;
        }

        // Delete the record owned by the user
        $stmt = $pdo->prepare(
            "DELETE FROM service_user WHERE id = ?"
        );

        $stmt->execute([$service_id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Service not found or not owned by user']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}