<?php
require_once __DIR__ . '/../config.php';

$pdo = null;
$db_error = null;

try {
    // Primary: SQLite (Zero-config, works everywhere for this demo)
    $sqlite_path = __DIR__ . '/../database.sqlite';
    $pdo = new PDO("sqlite:$sqlite_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e_sqlite) {
    // Fallback: MySQL (If SQLite fails for some reason)
    try {
        $dsn = "mysql:host=127.0.0.1;dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e_mysql) {
        $db_error = "Database Connection Failed. ";
        $db_error .= "SQLite Error: " . $e_sqlite->getMessage() . " | ";
        $db_error .= "MySQL Error: " . $e_mysql->getMessage();
    }
}
?>
