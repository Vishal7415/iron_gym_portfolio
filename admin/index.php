<?php
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    redirect('login.php');
}

// Get stats
$member_count = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
$lead_count = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'New'")->fetchColumn();
$total_revenue = $pdo->query("SELECT SUM(fee) FROM members")->fetchColumn() ?: 0;
$expiring_soon = $pdo->query("SELECT COUNT(*) FROM members WHERE expiry_date <= date('now', '+7 days')")->fetchColumn();

// Get recent leads
$recent_leads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ironman Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .sidebar { min-height: 100vh; background: #0a0a0a; border-right: 1px solid #333; }
        .nav-link.active { background: var(--gold); color: black !important; }
        .stat-card { border-left: 4px solid var(--gold); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 d-none d-md-block sidebar p-0 position-fixed">
            <div class="p-4 text-center">
                <h4 class="text-gold fw-bold mb-0">IRONMAN</h4>
                <small class="text-muted">GYM ADMIN</small>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link active py-3 px-4" href="index.php"><i class="fas fa-home me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="members.php"><i class="fas fa-users me-2"></i> Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="leads.php"><i class="fas fa-bullhorn me-2"></i> Leads <span class="badge bg-danger ms-1"><?php echo $lead_count; ?></span></a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link py-3 px-4 text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 offset-md-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Dashboard Summary</h2>
                <a href="members.php?action=add" class="btn btn-gold"><i class="fas fa-plus me-2"></i> Add New Member</a>
            </div>

            <?php if ($flash = get_flash()): ?>
                <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show">
                    <?php echo $flash['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Stats Row -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card stat-card p-4">
                        <small class="text-muted uppercase mb-1 d-block">TOTAL MEMBERS</small>
                        <h2 class="fw-bold mb-0 text-gold"><?php echo $member_count; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card p-4">
                        <small class="text-muted uppercase mb-1 d-block">NEW LEADS</small>
                        <h2 class="fw-bold mb-0 text-gold"><?php echo $lead_count; ?></h2>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card p-4">
                        <small class="text-muted uppercase mb-1 d-block">TOTAL REVENUE</small>
                        <h2 class="fw-bold mb-0 text-gold">₹<?php echo number_format($total_revenue); ?></h2>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card p-4">
                        <small class="text-muted uppercase mb-1 d-block">EXPIRING SOON</small>
                        <h2 class="fw-bold mb-0 text-danger"><?php echo $expiring_soon; ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Leads Table -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-gold">Recent Website Leads</h5>
                            <a href="leads.php" class="btn btn-sm btn-outline-gold">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Goal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($recent_leads)): ?>
                                            <tr><td colspan="4" class="text-center py-4">No recent leads.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($recent_leads as $lead): ?>
                                            <tr>
                                                <td><?php echo $lead['name']; ?></td>
                                                <td><?php echo $lead['phone']; ?></td>
                                                <td><?php echo $lead['goal']; ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $lead['status'] === 'New' ? 'danger' : 'success'; ?>">
                                                        <?php echo $lead['status']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-dark"><h5 class="mb-0 text-gold">Quick Actions</h5></div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="members.php" class="btn btn-outline-gold text-start"><i class="fas fa-search me-2"></i> Search Member</a>
                                <a href="leads.php" class="btn btn-outline-gold text-start"><i class="fas fa-phone me-2"></i> Call Recent Lead</a>
                                <a href="members.php?action=add" class="btn btn-outline-gold text-start"><i class="fas fa-file-invoice me-2"></i> Generate Bill</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
