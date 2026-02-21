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
    <!-- Custom CSS (Inlined for Vercel serverless compatibility) -->
    <style>
        :root {
            --gold: #D4AF37;
            --dark-gold: #B8860B;
            --dark-bg: #121212;
            --darker-bg: #0a0a0a;
            --light-text: #e0e0e0;
            --muted-text: #888888;
        }
        body { background-color: var(--dark-bg); color: var(--light-text); font-family: 'Inter', sans-serif; }
        .bg-dark-gold { background-color: var(--gold) !important; }
        .bg-gold { background-color: var(--gold) !important; }
        .bg-darker-bg { background-color: var(--darker-bg) !important; }
        .text-gold { color: var(--gold) !important; }
        .btn-gold { background-color: var(--gold); color: var(--darker-bg); font-weight: bold; border: none; transition: all 0.3s ease; }
        .btn-gold:hover { background-color: var(--dark-gold); color: white; transform: translateY(-2px); }
        .btn-outline-gold { border: 1px solid var(--gold); color: var(--gold); transition: all 0.3s ease; }
        .btn-outline-gold:hover { background-color: var(--gold); color: var(--darker-bg); }
        .navbar { background-color: rgba(10, 10, 10, 0.95); border-bottom: 2px solid var(--gold); }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: var(--gold) !important; text-transform: uppercase; letter-spacing: 2px; }
        .nav-link { color: var(--light-text) !important; font-weight: 500; }
        .nav-link:hover, .nav-link.active { color: var(--gold) !important; }
        .hero-section { padding: 100px 0; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; border-bottom: 5px solid var(--gold); }
        .section-title { color: var(--gold); text-transform: uppercase; font-weight: 700; margin-bottom: 30px; position: relative; }
        .section-title:after { content: ''; display: block; width: 50px; height: 3px; background: var(--gold); margin-top: 10px; }
        .card { background-color: var(--darker-bg); border: 1px solid #333; transition: transform 0.3s ease; }
        .card:hover { transform: translateY(-5px); border-color: var(--gold); }
        .card-title { color: var(--gold); }
        .whatsapp-btn { position: fixed; bottom: 30px; right: 30px; background-color: #25d366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); z-index: 1000; }
        .footer { background-color: var(--darker-bg); padding: 50px 0; border-top: 2px solid var(--gold); }
        .form-control { background-color: #222; border: 1px solid #444; color: white; }
        .form-control:focus { background-color: #2a2a2a; border-color: var(--gold); color: white; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .membership-card { border-top: 5px solid var(--gold); }
        .price { font-size: 2.5rem; font-weight: 800; color: var(--gold); }
        /* Admin panel styles */
        .sidebar { background-color: var(--darker-bg); border-right: 2px solid var(--gold); min-height: 100vh; padding: 20px 0; }
        .sidebar a { color: var(--light-text); text-decoration: none; display: block; padding: 12px 20px; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: rgba(212,175,55,0.15); color: var(--gold); border-left: 3px solid var(--gold); }
        .stat-card { background: var(--darker-bg); border: 1px solid #333; border-left: 4px solid var(--gold); border-radius: 8px; padding: 20px; }
        .table { color: var(--light-text); }
        .table-dark { background-color: var(--darker-bg); }
        .badge-active { background-color: #28a745; }
        .badge-expired { background-color: #dc3545; }
        .text-muted { color: var(--muted-text) !important; }
    </style>
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
