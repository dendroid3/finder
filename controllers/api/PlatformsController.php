<?php
namespace Controllers\api;

class PlatformsController
{
    public function get()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        $stmt = $pdo->prepare("SELECT id, title FROM platforms");
        $stmt->execute();
        $platforms = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($platforms);
    }
}
