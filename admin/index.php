<?php
require_once __DIR__ . '/admin_layout.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

// Stats
$member_count   = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
$lead_count     = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'New'")->fetchColumn();
$total_revenue  = $pdo->query("SELECT SUM(fee) FROM members")->fetchColumn() ?: 0;
$expiring_soon  = $pdo->query("SELECT COUNT(*) FROM members WHERE expiry_date <= date('now', '+7 days') AND expiry_date >= date('now')")->fetchColumn();

// Recent leads
$recent_leads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Recent members
$recent_members = $pdo->query("SELECT * FROM members ORDER BY created_at DESC LIMIT 5")->fetchAll();

adminHead("Dashboard");
adminSidebar("dashboard", (int)$lead_count);
?>

<div class="admin-topbar">
    <h1><i class="fas fa-chart-line me-2" style="color:var(--gold);font-size:1rem;"></i> Dashboard</h1>
    <a href="members.php?action=add" class="btn-gold btn"><i class="fas fa-plus me-2"></i> Add Member</a>
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
                <div class="stat-icon red"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="stat-value"><?php echo $expiring_soon; ?></div>
                    <div class="stat-label">Expiring in 7 Days</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Recent Leads -->
        <div class="col-lg-8">
            <div class="a-card h-100">
                <div class="a-card-header">
                    <h5><i class="fas fa-bullhorn me-2" style="color:var(--gold);"></i> Recent Leads</h5>
                    <a href="leads.php" class="btn-outline-gold btn btn-sm">View All</a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="a-table">
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
                            <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:32px;">No leads yet. They'll appear when visitors submit the contact form.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recent_leads as $l): ?>
                            <tr>
                                <td class="fw-semibold"><?php echo htmlspecialchars($l['name']); ?></td>
                                <td style="color:var(--text-muted);"><?php echo htmlspecialchars($l['phone']); ?></td>
                                <td style="color:var(--text-muted);"><?php echo htmlspecialchars($l['goal']); ?></td>
                                <td>
                                    <?php if ($l['status'] === 'New'): ?>
                                        <span class="badge-danger">New</span>
                                    <?php else: ?>
                                        <span class="badge-success">Contacted</span>
                                    <?php endif; ?>
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
                    <a href="members.php" class="btn-outline-gold btn text-start"><i class="fas fa-search me-2"></i> Search Members</a>
                    <a href="leads.php" class="btn-outline-gold btn text-start"><i class="fas fa-phone me-2"></i> Contact Leads</a>
                    <a href="members.php?action=add" class="btn-gold btn text-start"><i class="fas fa-user-plus me-2"></i> Add New Member</a>
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
