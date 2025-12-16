<?php
$database_name = "";
$database_user = "";
$database_password = "";
$pdo = new PDO(
    "mysql:host=localhost;dbname=$database_name;charset=utf8mb4",
    $database_user,
    $database_password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

$migrations = glob(__DIR__ . '/migrations/*.php');
sort($migration);

foreach ($migrations as $migration) {
    echo "Running: " . basename($migration) . PHP_EOL;
    $sql = require $migration;
    $pdo->exec($sql);
}

echo "Migrations completed.\n";
