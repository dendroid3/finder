<?php
$database_name = "finder";
$database_user = "root";
$database_password = "password";
$pdo = new PDO(
    "mysql:host=localhost;dbname=$database_name;charset=utf8mb4",
    $database_user,
    $database_password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

$migrations = glob(__DIR__ . '/migrations/*.php');

foreach ($migrations as $migration) {
    echo "Running: " . basename($migration) . PHP_EOL;
    $sql = require $migration;
    $pdo->exec($sql);
}

echo "Migrations completed.\n";
