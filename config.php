<?php
// Ironman Gym Demo Configuration

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'ironman_gym');
define('DB_USER', 'root');
define('DB_PASS', '');

// Website Information
define('GYM_NAME', 'Ironman Gym');
define('GYM_PHONE', '09826043222');
define('GYM_ADDRESS', '118 Ashoka Estate, Beside Apsara Talkies, Raisen Road, Bhopal, Madhya Pradesh 462023');
define('GYM_LOCATION_LAT', '23.2500'); // Mock Lat
define('GYM_LOCATION_LNG', '77.4167'); // Mock Lng

// Session start (local dev fallback)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Stateless Cookie Auth (for Vercel serverless) ---
define('ADMIN_SECRET', 'ironman_gym_secret_2026');
define('ADMIN_COOKIE', 'igym_auth');

function admin_login_set($username) {
    $token = hash_hmac('sha256', $username . '|ironman_admin', ADMIN_SECRET);
    $value = base64_encode($username . '|' . $token);
    setcookie(ADMIN_COOKIE, $value, time() + 86400, '/', '', false, true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
}

function admin_is_logged_in() {
    // Check session first (local dev)
    if (isset($_SESSION['admin_logged_in'])) return true;
    // Check cookie (Vercel serverless)
    if (!isset($_COOKIE[ADMIN_COOKIE])) return false;
    $parts = explode('|', base64_decode($_COOKIE[ADMIN_COOKIE]), 2);
    if (count($parts) !== 2) return false;
    [$username, $token] = $parts;
    $expected = hash_hmac('sha256', $username . '|ironman_admin', ADMIN_SECRET);
    return hash_equals($expected, $token);
}

function admin_logout() {
    setcookie(ADMIN_COOKIE, '', time() - 3600, '/');
    session_destroy();
}

// Helper functions
function redirect($url) {
    header("Location: $url");
    exit();
}

function flash($message, $type = 'success') {
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function get_flash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}
?>
