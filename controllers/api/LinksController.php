<?php
namespace Controllers\api;

class LinksController
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
        $platform_id = $input['platform_id'] ?? null;
        $username = $input['username'] ?? null;
        $user_code = $input['user_code'] ?? null;

        $stmt = $pdo->prepare("SELECT id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user_id = $user['id'];
        if (!$platform_id || !$username) {
            throw new \Exception(message: "Platform and username required");
        }

        // Insert
        $stmt = $pdo->prepare(
            "INSERT INTO link_user (user_id, platform_id, username)
         VALUES (?, ?, ?)"
        );

        $stmt->execute([
            $user_id,
            $platform_id,
            $username
        ]);

        // Success response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'link_user_id' => $pdo->lastInsertId()
        ]);
    }
    public function get()
    {
        $pdo = new \PDO(
            'mysql:host=localhost;dbname=finder;charset=utf8mb4',
            'root',
            'password',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        $user_code = $_GET['user_code'] ?? null;
        if (!$user_code) {
            throw new \Exception("User code missing");
        }

        // Get user ID
        $stmt = $pdo->prepare("SELECT id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user_id = $user['id'];

        // JOIN link_user with platforms
        $stmt = $pdo->prepare("
        SELECT 
            lu.id,
            lu.username,
            lu.created_at,

            p.id   AS platform_id,
            p.title,
            p.url,
            p.icon_url
        FROM link_user lu
        INNER JOIN platforms p 
            ON lu.platform_id = p.id
        WHERE lu.user_id = ?
        ORDER BY lu.created_at DESC
    ");

        $stmt->execute([$user_id]);
        $links = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Return JSON
        header('Content-Type: application/json');
        echo json_encode($links);
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

        $link_id = $input['link_id'] ?? $_GET['link_id'] ?? null;

        if (!$link_id) {
            http_response_code(400);
            echo json_encode(['error' => 'link_id missing']);
            return;
        }

        // Delete the record owned by the user
        $stmt = $pdo->prepare(
            "DELETE FROM link_user WHERE id = ?"
        );

        $stmt->execute([$link_id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Link not found or not owned by user']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Link deleted successfully'
        ]);
    }
}