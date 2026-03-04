<?php
require_once __DIR__ . '/admin_layout.php';

if (!admin_is_logged_in()) {
    die("Unauthorized");
}

// Detect Vercel database path
$is_vercel = (getenv('APP_ENV') === 'production' || !is_writable(__DIR__ . '/../'));
$sqlite_path = $is_vercel ? '/tmp/database.sqlite' : __DIR__ . '/../database.sqlite';

if (file_exists($sqlite_path)) {
    header('Content-Type: application/x-sqlite3');
    header('Content-Disposition: attachment; filename="tfe_backup_' . date('Y-m-d_Hi') . '.sqlite"');
    header('Content-Length: ' . filesize($sqlite_path));
    readfile($sqlite_path);
    exit;
} else {
    die("Backup file not found. Ensure the database has been initialized.");
}
?>
