<?php
namespace Controllers\api;

class ReferencesController
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

        

        // Input

        $input = json_decode(file_get_contents('php://input'), true);
        $referee = $input['referee'] ?? null;
        $description = $input['description'] ?? null;
        $user_code = $input['user_code'] ?? null;

        $stmt = $pdo->prepare("SELECT id FROM users WHERE code = ?");
        $stmt->execute([$user_code]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            throw new \Exception("User not found");
        }

        $user_id = $user['id'];

        if (!$referee || !$description) {
            throw new \Exception("Referee and description required");
        }

        // Insert
        $stmt = $pdo->prepare(
            "INSERT INTO reference_user (user_id, referee, description)
         VALUES (?, ?, ?)"
        );

        $stmt->execute([
            $user_id,
            $referee,
            $description
        ]);

        // Success response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'reference_user_id' => $pdo->lastInsertId()
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
        $stmt = $pdo->prepare("SELECT * FROM reference_user WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $references = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($references);
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

        // Auth check
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            throw new \Exception("Unauthenticated");
        }

        // Read raw input (JSON)
        $input = json_decode(file_get_contents('php://input'), true);

        // Fallback for form-encoded
        if (!is_array($input)) {
            parse_str(file_get_contents('php://input'), $input);
        }

        // Final fallback: query string
        $reference_id = $input['reference_id'] ?? $_GET['reference_id'] ?? null;

        if (!$reference_id) {
            http_response_code(400);
            echo json_encode(['error' => 'reference_id missing']);
            return;
        }

        // Delete the record owned by the user
        $stmt = $pdo->prepare(
            "DELETE FROM reference_user WHERE id = ? AND user_id = ?"
        );

        $stmt->execute([$reference_id, $user_id]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Reference not found or not owned by user']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Reference deleted successfully'
        ]);
    }

}
