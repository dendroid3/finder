<?php
$database_name = "finder";
$database_user = "root";
$database_password = "password";

$pdo = new PDO(
    "mysql:host=localhost;dbname=$database_name;charset=utf8mb4",
    $database_user,
    $database_password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => true
    ]
);

$seeders = glob(__DIR__ . '/seeders/*.php');

foreach ($seeders as $seed) {
    echo "Running: " . basename($seed) . PHP_EOL;
    $sql = require $seed;
    $pdo->exec($sql);
}

echo "Seeding completed.\n";
