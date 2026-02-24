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
    <!-- Google Fonts - Premium Stack -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== PREMIUM WARM DESIGN SYSTEM ===== */
        :root {
            --primary: #B8860B;
            --primary-light: #D4AF37;
            --primary-lighter: #EDD9A3;
            --primary-dark: #8B6914;
            --primary-glow: rgba(184, 134, 11, 0.12);
            --bg-body: #F8F5F0;
            --bg-white: #FDF9F3;
            --bg-cream: #F8F5F0;
            --bg-warm: #F2EDE5;
            --bg-section: #EDE8DF;
            --card-bg: rgba(255, 253, 248, 0.85);
            --card-border: rgba(180, 160, 120, 0.12);
            --text-dark: #2C2416;
            --text-body: #5A4D3C;
            --text-muted: #9A8D7A;
            --accent-gradient: linear-gradient(135deg, #D4AF37 0%, #B8860B 50%, #8B6914 100%);
            --warm-gradient: linear-gradient(135deg, #F5E6B8 0%, #E8D5A0 100%);
            --hero-overlay: linear-gradient(135deg, rgba(26,20,10,0.88) 0%, rgba(44,36,22,0.75) 100%);
            --shadow-sm: 0 2px 12px rgba(140, 120, 80, 0.06);
            --shadow-md: 0 8px 30px rgba(140, 120, 80, 0.08);
            --shadow-lg: 0 20px 60px rgba(140, 120, 80, 0.1);
            --shadow-gold: 0 8px 30px rgba(184, 134, 11, 0.15);
        }

        /* === BASE === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: var(--bg-body);
            background-image: 
                radial-gradient(ellipse at 0% 0%, rgba(212, 175, 55, 0.04) 0%, transparent 50%),
                radial-gradient(ellipse at 100% 100%, rgba(184, 134, 11, 0.03) 0%, transparent 50%);
            background-attachment: fixed;
            color: var(--text-body);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text-dark);
        }

        /* === SCROLLBAR === */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-warm); }
        ::-webkit-scrollbar-thumb { background: var(--primary-light); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* === UTILITY === */
        .text-gold { color: var(--primary) !important; }
        .text-gold-light { color: var(--primary-light) !important; }
        .bg-gold { background: var(--primary) !important; }
        .bg-dark-gold { background: var(--primary) !important; }
        .bg-darker-bg { background-color: var(--bg-section) !important; }
        .gradient-text {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* === BUTTONS === */
        .btn-gold {
            background: var(--accent-gradient);
            color: #fff;
            font-weight: 700;
            border: none;
            padding: 12px 32px;
            border-radius: 12px;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--shadow-gold);
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        .btn-gold:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(184, 134, 11, 0.3);
            color: #fff;
        }
        .btn-gold:active { transform: translateY(-1px); }

        .btn-outline-gold {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 12px;
            padding: 10px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.4s ease;
            background: transparent;
        }
        .btn-outline-gold:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
        }

        /* === NAVBAR === */
        .navbar {
            background: rgba(248, 245, 240, 0.92);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(180, 160, 120, 0.1);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            padding: 8px 0;
            background: rgba(248, 245, 240, 0.97);
            box-shadow: 0 4px 20px rgba(140, 120, 80, 0.08);
        }
        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: 2px;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link {
            color: var(--text-body) !important;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            position: relative;
            padding: 8px 16px !important;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--accent-gradient);
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .nav-link:hover::after, .nav-link.active::after { width: 50%; }
        .navbar-toggler { border: 1px solid var(--primary-lighter); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(184,134,11,1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* === HERO === */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: 
                var(--hero-overlay),
                url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(transparent, var(--bg-cream));
            z-index: 1;
        }
        .hero-section .container { position: relative; z-index: 2; }
        .hero-badge {
            display: inline-block;
            padding: 8px 24px;
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            background: rgba(212, 175, 55, 0.08);
            animation: fadeInDown 0.8s ease;
        }
        .hero-title {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease 0.2s both;
            color: #fff;
        }
        .hero-subtitle {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
            animation: fadeInUp 0.8s ease 0.4s both;
        }
        .hero-buttons { animation: fadeInUp 0.8s ease 0.6s both; }
        .hero-section .btn-outline-gold {
            border-color: rgba(255,255,255,0.4);
            color: #fff;
        }
        .hero-section .btn-outline-gold:hover {
            background: rgba(255,255,255,0.15);
            border-color: #fff;
            color: #fff;
        }

        /* === SECTIONS === */
        .section-title {
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 3px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
        .section-title:after { display: none; }
        .section-heading {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        /* === GLASS CARDS === */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-lighter);
            box-shadow: var(--shadow-lg);
        }
        .card-title { color: var(--primary); }

        /* === MEMBERSHIP CARDS === */
        .membership-card {
            position: relative;
            overflow: hidden;
        }
        .membership-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-gradient);
        }
        .membership-card.featured {
            border: 2px solid var(--primary-light);
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(180deg, #FFFDF5 0%, #FFFFFF 100%) !important;
        }
        .membership-card.featured::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.03) 0%, transparent 70%);
            animation: pulse-glow 4s ease-in-out infinite;
        }
        .price {
            font-size: 3rem;
            font-weight: 900;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* === STATS === */
        .stats-section {
            background: var(--bg-white);
            border-top: 1px solid var(--card-border);
            border-bottom: 1px solid var(--card-border);
        }
        .stat-item {
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }
        .stat-item::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 40px;
            background: linear-gradient(transparent, var(--card-border), transparent);
        }
        .stat-item:last-child::after { display: none; }
        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }
        .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        /* === TESTIMONIALS === */
        .testimonial-card { position: relative; padding: 2rem; }
        .testimonial-card .quote-icon {
            font-size: 3rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0.2;
            position: absolute;
            top: 15px;
            left: 20px;
        }
        .testimonial-stars { color: var(--primary-light); margin-bottom: 15px; }
        .testimonial-text { font-style: italic; color: var(--text-body); line-height: 1.8; margin-bottom: 1.5rem; }
        .testimonial-author { font-weight: 700; color: var(--primary); }

        /* === FOOTER === */
        .footer {
            background: var(--text-dark);
            padding: 80px 0 30px;
            color: rgba(255,255,255,0.7);
            position: relative;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-gradient);
        }
        .footer h4, .footer h5, .footer h6 { color: #fff; }
        .footer .text-muted { color: rgba(255,255,255,0.5) !important; }
        .footer-link {
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            display: block;
            padding: 6px 0;
            transition: all 0.3s ease;
            font-weight: 400;
        }
        .footer-link:hover { color: var(--primary-light); transform: translateX(5px); }
        .footer .feature-icon {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.2);
        }
        .footer .btn-outline-gold {
            border-color: rgba(212, 175, 55, 0.4);
            color: var(--primary-light);
        }
        .footer .btn-outline-gold:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* === WHATSAPP BUTTON === */
        .whatsapp-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #25d366, #128C7E);
            color: white;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
            z-index: 1000;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: bounce-in 1s ease 2s both;
        }
        .whatsapp-btn:hover {
            transform: scale(1.1) translateY(-3px);
            box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
            color: white;
        }

        /* === FORM CONTROLS === */
        .form-control, .form-select {
            background: var(--bg-cream);
            border: 1px solid rgba(0,0,0,0.08);
            color: var(--text-dark);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background: var(--bg-white);
            border-color: var(--primary-light);
            color: var(--text-dark);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.12);
        }
        .form-control::placeholder { color: var(--text-muted); }

        /* === FEATURE ICONS === */
        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-glow);
            border: 1px solid var(--primary-lighter);
            color: var(--primary);
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        .feature-icon:hover { background: var(--primary-lighter); transform: scale(1.05); }

        /* === GLOW LINE === */
        .glow-line {
            width: 80px;
            height: 3px;
            background: var(--accent-gradient);
            border-radius: 3px;
        }

        /* === SECTION DIVIDERS === */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--card-border), transparent);
        }
        .gold-top-line {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--accent-gradient);
        }

        /* === ADMIN === */
        .sidebar { background-color: #1a1a1a; border-right: 1px solid rgba(255,255,255,0.06); min-height: 100vh; }
        .sidebar a { color: rgba(255,255,255,0.7); text-decoration: none; display: block; padding: 12px 20px; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(212,175,55,0.1); color: var(--primary-light); border-left: 3px solid var(--primary-light); }
        .stat-card { background: var(--card-bg); border: 1px solid var(--card-border); border-left: 4px solid var(--primary); border-radius: 12px; padding: 20px; }
        .table { color: var(--text-body); }
        .table-dark { background-color: #1a1a1a; color: rgba(255,255,255,0.8); }
        .badge-active { background-color: #28a745; }
        .badge-expired { background-color: #dc3545; }
        .text-muted { color: var(--text-muted) !important; }

        /* === ANIMATIONS === */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.8; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes bounce-in {
            0% { opacity: 0; transform: scale(0.3); }
            50% { transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.2rem; }
            .stat-item::after { display: none; }
            .stat-number { font-size: 2rem; }
            .price { font-size: 2.2rem; }
            .membership-card.featured { transform: scale(1); }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-dumbbell me-2"></i> THE FITNESS EMPIRE
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
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
                    <a class="btn btn-gold px-4 py-2" href="membership.php#join">JOIN NOW</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Scroll Animation Script -->
<script>
window.addEventListener('scroll', function() {
    const nav = document.querySelector('.navbar');
    if (window.scrollY > 50) nav.classList.add('scrolled');
    else nav.classList.remove('scrolled');
});
const animateOnScroll = () => {
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 50) el.classList.add('visible');
    });
};
window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);
</script>

<?php if (isset($db_error) && $db_error): ?>
    <div class="alert alert-danger mb-0 text-center rounded-0">
        <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $db_error; ?>. 
        Please ensure your database is set up correctly.
    </div>
<?php endif; ?>
