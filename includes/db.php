<?php
require_once __DIR__ . '/../config.php';

$pdo = null;
$db_error = null;

try {
    // On Vercel, the filesystem is read-only except /tmp.
    // Detect Vercel by checking APP_ENV or the /tmp writable path.
    $is_vercel = (getenv('APP_ENV') === 'production' || !is_writable(__DIR__ . '/../'));
    $sqlite_path = $is_vercel ? '/tmp/database.sqlite' : __DIR__ . '/../database.sqlite';

    $pdo = new PDO("sqlite:$sqlite_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Required for writable SQLite on Vercel /tmp (avoids filesystem lock errors)
    $pdo->exec('PRAGMA journal_mode = MEMORY');
    $pdo->exec('PRAGMA synchronous = OFF');
    $pdo->exec('PRAGMA temp_store = MEMORY');

    // Auto-seed: create tables and default admin if they don't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS members (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT DEFAULT '',
        plan_type TEXT NOT NULL,
        start_date TEXT NOT NULL,
        duration_months INTEGER NOT NULL,
        expiry_date TEXT NOT NULL,
        fee REAL NOT NULL,
        source TEXT DEFAULT 'Admin',
        utr TEXT DEFAULT '',
        payment_status TEXT DEFAULT 'Verified',
        diet_plan_sent INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    // Add columns to existing DBs (SQLite ignores if already exists via try/catch)
    try { $pdo->exec("ALTER TABLE members ADD COLUMN email TEXT DEFAULT ''"); } catch(Exception $e){}
    try { $pdo->exec("ALTER TABLE members ADD COLUMN source TEXT DEFAULT 'Admin'"); } catch(Exception $e){}
    try { $pdo->exec("ALTER TABLE members ADD COLUMN utr TEXT DEFAULT ''"); } catch(Exception $e){}
    try { $pdo->exec("ALTER TABLE members ADD COLUMN payment_status TEXT DEFAULT 'Verified'"); } catch(Exception $e){}

    $pdo->exec("CREATE TABLE IF NOT EXISTS leads (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        phone TEXT NOT NULL,
        goal TEXT,
        status TEXT DEFAULT 'New',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS invoices (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        invoice_no TEXT NOT NULL UNIQUE,
        member_id INTEGER NOT NULL,
        amount REAL NOT NULL,
        billing_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Insert default admin if not exists (password: admin123)
    $existing = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($existing == 0) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $hash]);
    }

} catch (PDOException $e) {
    $db_error = "Database Error: " . $e->getMessage();
}
?>
