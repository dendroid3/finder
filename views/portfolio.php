<?php

session_start();

$pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$path = trim($path, '/');

$user_code = explode('/', $path)[0];

// Check if there's a user with that code
$stmt = $pdo->prepare("SELECT * FROM users WHERE code = ?");
$stmt->execute([$user_code]);
$user = $stmt->fetch(\PDO::FETCH_ASSOC);

$templateId = basename($user['template_id']);
require_once __DIR__ . "/templates/$templateId/index.php";
