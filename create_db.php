<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=3307", "root", "root");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS pfe_services");
    echo "Database created or already exists.\n";
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage() . "\n");
}
