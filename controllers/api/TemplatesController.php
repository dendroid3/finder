<?php

namespace Controllers\Api;

class TemplatesController
{
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
        $template_id = $input['template_id'] ?? null;

        if (!$template_id) {
            http_response_code(400);
            echo json_encode(['error' => 'user_code or template id missing']);
            return;
        }

        $stmt = $pdo->prepare(
            "UPDATE users SET template_id = ? WHERE code = ?"
        );

        $stmt->execute([$template_id, $user_code]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found or no change made']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Template updated successfully'
        ]);
    }

}