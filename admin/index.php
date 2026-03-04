<?php
require_once __DIR__ . '/admin_layout.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

// Stats
$member_count   = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
$lead_count     = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'New'")->fetchColumn();
$pending_count  = $pdo->query("SELECT COUNT(*) FROM members WHERE payment_status = 'Pending'")->fetchColumn();
$total_revenue  = $pdo->query("SELECT SUM(fee) FROM members WHERE payment_status = 'Verified'")->fetchColumn() ?: 0;
$expiring_soon  = $pdo->query("SELECT COUNT(*) FROM members WHERE expiry_date <= date('now', '+7 days') AND expiry_date >= date('now')")->fetchColumn();

// Recent pending members
$pending_members = $pdo->query("SELECT * FROM members WHERE payment_status = 'Pending' ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Recent leads
$recent_leads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Recent members
$recent_members = $pdo->query("SELECT * FROM members ORDER BY created_at DESC LIMIT 5")->fetchAll();

adminHead("Dashboard");
adminSidebar("dashboard", (int)$lead_count, (int)$pending_count);
?>

<div class="admin-topbar">
    <h1>
        <div class="mobile-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
        <i class="fas fa-chart-line me-2" style="color:var(--gold);font-size:1rem;"></i> Dashboard
    </h1>
    <a href="/admin/members.php?action=add" class="btn-gold btn"><i class="fas fa-plus me-2"></i> Add Member</a>
</div>

<div class="admin-content">

    <?php renderFlash(); ?>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon gold"><i class="fas fa-users"></i></div>
                <div>
                    <div class="stat-value"><?php echo $member_count; ?></div>
                    <div class="stat-label">Total Members</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="fas fa-indian-rupee-sign"></i></div>
                <div>
                    <div class="stat-value">₹<?php echo number_format($total_revenue); ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-bullhorn"></i></div>
                <div>
                    <div class="stat-value"><?php echo $lead_count; ?></div>
                    <div class="stat-label">New Leads</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon gold"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="stat-value"><?php echo $pending_count; ?></div>
                    <div class="stat-label">Pending Payments</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Pending Registrations -->
        <div class="col-lg-8">
            <div class="a-card mb-4">
                <div class="a-card-header">
                    <h5><i class="fas fa-clock me-2" style="color:var(--gold);"></i> Registration Requests (Pending Payment)</h5>
                    <a href="/admin/members.php" class="btn-gold btn px-4">View All Members</a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="a-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Plan</th>
                                <th>UTR Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($pending_members)): ?>
                            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:32px;">No pending registrations.</td></tr>
                        <?php else: ?>
                            <?php foreach ($pending_members as $pm): ?>
                            <tr>
                                <td class="fw-semibold"><?php echo htmlspecialchars($pm['name']); ?></td>
                                <td style="color:var(--text-muted);"><?php echo htmlspecialchars($pm['phone']); ?></td>
                                <td style="color:var(--text-muted);"><?php echo htmlspecialchars($pm['plan_type']); ?></td>
                                <td style="color:var(--gold); font-family: monospace; font-weight: 700;"><?php echo htmlspecialchars($pm['utr']); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/admin/members.php?action=verify_payment&id=<?php echo $pm['id']; ?>" class="btn-act btn-act-green" title="Verify Payment" data-confirm="Verify this payment?"><i class="fas fa-check"></i></a>
                                        <a href="/admin/members.php?action=reject_payment&id=<?php echo $pm['id']; ?>" class="btn-act btn-act-red" title="Reject Payment" data-confirm="Reject this payment?"><i class="fas fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="a-card h-100">
                <div class="a-card-header">
                    <h5><i class="fas fa-bolt me-2" style="color:var(--gold);"></i> Quick Actions</h5>
                </div>
                <div class="a-card-body d-grid gap-2">
                    <a href="/admin/members.php" class="btn-outline-gold btn text-start"><i class="fas fa-search me-2"></i> Search Members</a>
                    <a href="/admin/leads.php" class="btn-outline-gold btn text-start"><i class="fas fa-phone me-2"></i> Contact Leads</a>
                    <a href="/admin/members.php?action=add" class="btn-gold btn text-start"><i class="fas fa-user-plus me-2"></i> Add New Member</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Members -->
    <div class="a-card mt-3">
        <div class="a-card-header">
            <h5><i class="fas fa-users me-2" style="color:var(--gold);"></i> Recent Members</h5>
            <a href="members.php" class="btn-outline-gold btn btn-sm">View All</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="a-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Plan</th>
                        <th>Expiry</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($recent_members)): ?>
                    <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:32px;">No members yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($recent_members as $m): 
                        $is_expired = strtotime($m['expiry_date']) < time();
                    ?>
                    <tr>
                        <td class="fw-semibold"><?php echo htmlspecialchars($m['name']); ?></td>
                        <td style="color:var(--text-muted);"><?php echo htmlspecialchars($m['phone']); ?></td>
                        <td style="color:var(--text-muted);"><?php echo htmlspecialchars($m['plan_type']); ?></td>
                        <td style="color:<?php echo $is_expired ? '#EF4444' : 'var(--text-muted)'; ?>;">
                            <?php echo date('d M, Y', strtotime($m['expiry_date'])); ?>
                        </td>
                        <td>
                            <?php echo $is_expired 
                                ? '<span class="badge-danger">Expired</span>' 
                                : '<span class="badge-success">Active</span>'; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php adminEnd(); ?>
