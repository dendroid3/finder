<?php
namespace Controllers\api;

class TitleController
{
    public function get()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        $user_code = $_GET['user_code'] ?? null;
        if (!$user_code) {
            throw new \Exception("User code missing");
        }

        $stmt = $pdo->prepare("SELECT title, name, profile_picture_url, template_id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function update()
    {
        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
        
        // Auth check
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            // throw new \Exception("Unauthenticated");
        }

        // Read raw JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        $user_code = $input['user_code'] ?? null;
        $title = $input['title'] ?? null;

        if (!$title) {
            http_response_code(400);
            echo json_encode(['error' => 'user_code or title missing']);
            return;
        }

        $stmt = $pdo->prepare(
            "UPDATE users SET title = ? WHERE code = ?"
        );

        $stmt->execute([$title, $user_code]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found or no change made']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Title updated successfully'
        ]);
    }

    public function delete()
    {
        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        // Read raw input
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        // Fallback for form-encoded
        if (!is_array($data)) {
            parse_str($raw, $data);
        }

        // Final fallback (query string)
        $user_code = $data['user_code'] ?? $_GET['user_code'] ?? null;

        if (!$user_code) {
            http_response_code(400);
            echo json_encode(['error' => 'user_code missing']);
            return;
        }

        $stmt = $pdo->prepare(
            "UPDATE users SET title = NULL WHERE code = ?"
        );

        $stmt->execute([$user_code]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found or title already empty']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Title deleted successfully'
        ]);
    }

}
