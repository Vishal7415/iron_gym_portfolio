<?php
// Admin Layout Helper - included by all admin pages
// Usage: adminHead($title); ... adminSidebar($activePage); ... adminEnd();
require_once __DIR__ . '/../includes/db.php';

function adminHead(string $title): void { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> — Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #D4AF37;
            --gold-light: #F0D060;
            --gold-dark: #B8860B;
            --gold-glow: rgba(212,175,55,0.12);
            --sidebar-bg: #0D0D0F;
            --sidebar-border: rgba(212,175,55,0.1);
            --content-bg: #111318;
            --card-bg: #16181F;
            --card-border: rgba(255,255,255,0.06);
            --text-light: #F0EEE9;
            --text-muted: #7A7A8A;
            --success: #22C55E;
            --danger: #EF4444;
            --warning: #F59E0B;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--content-bg);
            color: var(--text-light);
            font-family: 'Outfit', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ---- SIDEBAR ---- */
        .admin-sidebar {
            width: 240px;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 28px 20px 20px;
            border-bottom: 1px solid var(--sidebar-border);
        }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--gold-glow);
            border: 1px solid rgba(212,175,55,0.3);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold); font-size: 1rem; margin-bottom: 12px;
        }
        .sidebar-brand h5 {
            color: var(--gold);
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }
        .sidebar-brand small { color: var(--text-muted); font-size: 0.72rem; }

        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .sidebar-nav .nav-label {
            color: var(--text-muted);
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
            padding: 4px 10px 8px;
            margin-top: 12px;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 3px;
            text-decoration: none;
        }
        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 0.85rem;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.04);
            color: var(--text-light);
        }
        .sidebar-nav .nav-link.active {
            background: var(--gold-glow);
            color: var(--gold);
            border-left: 3px solid var(--gold);
        }
        .sidebar-nav .nav-link.text-danger { color: #EF4444 !important; }
        .sidebar-nav .nav-link.text-danger:hover { background: rgba(239,68,68,0.08); }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--sidebar-border);
        }
        .sidebar-footer a {
            display: flex; align-items: center; gap: 10px;
            color: var(--text-muted); font-size: 0.85rem;
            text-decoration: none; transition: color 0.2s;
        }
        .sidebar-footer a:hover { color: var(--text-light); }

        /* ---- MAIN CONTENT ---- */
        .admin-main {
            margin-left: 240px;
            min-height: 100vh;
            padding: 0;
        }

        .admin-topbar {
            padding: 18px 32px;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--content-bg);
            position: sticky; top: 0; z-index: 50;
        }
        .admin-topbar h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-light);
            margin: 0;
        }

        .admin-content { padding: 28px 32px; }

        /* ---- STAT CARD ---- */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 24px;
            display: flex; align-items: flex-start; gap: 16px;
            transition: border-color 0.3s;
        }
        .stat-card:hover { border-color: rgba(212,175,55,0.2); }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .stat-icon.gold { background: var(--gold-glow); color: var(--gold); border: 1px solid rgba(212,175,55,0.2); }
        .stat-icon.green { background: rgba(34,197,94,0.1); color: #22C55E; border: 1px solid rgba(34,197,94,0.2); }
        .stat-icon.red { background: rgba(239,68,68,0.1); color: #EF4444; border: 1px solid rgba(239,68,68,0.2); }
        .stat-icon.blue { background: rgba(99,102,241,0.12); color: #818CF8; border: 1px solid rgba(99,102,241,0.2); }
        .stat-value { font-size: 1.8rem; font-weight: 800; color: var(--text-light); line-height: 1.1; }
        .stat-label { color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; }

        /* ---- CARD ---- */
        .a-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
        }
        .a-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--card-border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .a-card-header h5 { margin: 0; font-weight: 600; font-size: 0.95rem; }
        .a-card-body { padding: 20px; }

        /* ---- TABLE ---- */
        .a-table { width: 100%; border-collapse: collapse; }
        .a-table thead th {
            padding: 12px 16px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid var(--card-border);
        }
        .a-table tbody tr { border-bottom: 1px solid rgba(255,255,255,0.03); transition: background 0.15s; }
        .a-table tbody tr:hover { background: rgba(255,255,255,0.03); }
        .a-table tbody td { padding: 14px 16px; font-size: 0.9rem; vertical-align: middle; }

        /* ---- BUTTONS ---- */
        .btn-gold { background: var(--gold); color: #0D0D0F; font-weight: 700; border: none; font-size: 0.85rem; letter-spacing: 0.5px; border-radius: 10px; padding: 9px 20px; }
        .btn-gold:hover { background: var(--gold-dark); color: #fff; }
        .btn-outline-gold { border: 1px solid var(--gold); color: var(--gold); background: transparent; font-weight: 600; font-size: 0.85rem; border-radius: 10px; padding: 9px 20px; }
        .btn-outline-gold:hover { background: var(--gold-glow); color: var(--gold); }

        /* ---- FORM CONTROLS ---- */
        .form-control, .form-select {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--card-border);
            color: var(--text-light);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,0.06);
            border-color: var(--gold);
            color: var(--text-light);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
        }
        .form-control::placeholder { color: var(--text-muted); }
        .form-label { color: var(--text-muted); font-size: 0.8rem; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 6px; }
        .form-select option { background: #1a1a2e; color: var(--text-light); }

        /* ---- BADGE ---- */
        .badge-success { background: rgba(34,197,94,0.12); color: #22C55E; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(34,197,94,0.2); }
        .badge-danger { background: rgba(239,68,68,0.12); color: #EF4444; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(239,68,68,0.2); }
        .badge-warning { background: rgba(245,158,11,0.12); color: #F59E0B; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(245,158,11,0.2); }
        .badge-info { background: rgba(99,102,241,0.12); color: #818CF8; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(99,102,241,0.2); }
        .badge-secondary { background: rgba(255,255,255,0.06); color: var(--text-muted); padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; border: 1px solid var(--card-border); }

        /* action buttons */
        .btn-act { display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;font-size:0.8rem;border:1px solid;transition:all 0.2s; text-decoration:none; }
        .btn-act-green { border-color:rgba(34,197,94,0.3);color:#22C55E;background:rgba(34,197,94,0.08); }
        .btn-act-green:hover { background:rgba(34,197,94,0.18);color:#22C55E; }
        .btn-act-red { border-color:rgba(239,68,68,0.3);color:#EF4444;background:rgba(239,68,68,0.08); }
        .btn-act-red:hover { background:rgba(239,68,68,0.18);color:#EF4444; }
        .btn-act-gold { border-color:rgba(212,175,55,0.3);color:var(--gold);background:rgba(212,175,55,0.08); }
        .btn-act-gold:hover { background:rgba(212,175,55,0.18);color:var(--gold); }
        .btn-act-blue { border-color:rgba(99,102,241,0.3);color:#818CF8;background:rgba(99,102,241,0.08); }
        .btn-act-blue:hover { background:rgba(99,102,241,0.18);color:#818CF8; }

        /* Flash alerts */
        .flash-alert { border-radius: 12px; padding: 12px 20px; font-size: 0.9rem; margin-bottom: 20px; border: 1px solid; }
        .flash-success { background: rgba(34,197,94,0.08); color: #22C55E; border-color: rgba(34,197,94,0.2); }
        .flash-danger { background: rgba(239,68,68,0.08); color: #EF4444; border-color: rgba(239,68,68,0.2); }
        .flash-warning { background: rgba(245,158,11,0.08); color: #F59E0B; border-color: rgba(245,158,11,0.2); }

        /* Mobile */
        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-main { margin-left: 0; }
            .admin-content { padding: 16px; }
        }
    </style>
<?php }

function adminSidebar(string $active, int $leadCount = 0): void { ?>
</head>
<body>
<div class="admin-sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-dumbbell"></i></div>
        <h5><?php echo GYM_NAME; ?></h5>
        <small>Admin Panel</small>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>
        <a href="index.php"   class="nav-link <?php echo $active==='dashboard' ? 'active':'' ?>"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="members.php" class="nav-link <?php echo $active==='members'   ? 'active':'' ?>"><i class="fas fa-users"></i> Members</a>
        <a href="leads.php"   class="nav-link <?php echo $active==='leads'     ? 'active':'' ?>">
            <i class="fas fa-bullhorn"></i> Leads
            <?php if ($leadCount > 0): ?>
                <span style="margin-left:auto;background:rgba(239,68,68,0.15);color:#EF4444;border:1px solid rgba(239,68,68,0.25);border-radius:50px;font-size:0.7rem;padding:2px 8px;font-weight:600;"><?php echo $leadCount; ?></span>
            <?php endif; ?>
        </a>
        <div class="nav-label">Account</div>
        <a href="../index.php" class="nav-link" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
        <a href="logout.php"   class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</div>
<div class="admin-main">
<?php }

function adminEnd(): void { ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
<?php }

function renderFlash(): void {
    if ($flash = get_flash()) {
        $map = ['success'=>'flash-success','danger'=>'flash-danger','warning'=>'flash-warning'];
        $cls = $map[$flash['type']] ?? 'flash-success';
        echo "<div class=\"flash-alert {$cls}\"><i class=\"fas fa-info-circle me-2\"></i>{$flash['message']}</div>";
    }
}
?>
