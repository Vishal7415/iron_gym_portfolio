<?php
if (defined('HEADER_INCLUDED')) return;
define('HEADER_INCLUDED', true);
require_once __DIR__ . '/db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo GYM_NAME; ?> - Premium Fitness Destination</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-dumbbell me-2"></i> IRONMAN GYM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="membership.php">Membership</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-gold px-4" href="membership.php#join">JOIN NOW</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php if (getenv('APP_ENV') === 'production'): ?>
    <div class="alert alert-warning py-1 text-center small mb-0 rounded-0" style="font-size: 11px;">
        <i class="fas fa-info-circle me-1"></i> <strong>Note:</strong> This is a serverless demo. New data added here will not persist after session restarts.
    </div>
<?php endif; ?>

<?php if (isset($db_error) && $db_error): ?>
    <div class="alert alert-danger mb-0 text-center rounded-0">
        <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $db_error; ?>. 
        Please ensure your database is set up correctly.
    </div>
<?php endif; ?>
