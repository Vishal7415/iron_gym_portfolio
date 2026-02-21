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

// Session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
