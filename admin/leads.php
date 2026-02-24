<?php
require_once __DIR__ . '/admin_layout.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

if (isset($_GET['mark_contacted'])) {
    $pdo->prepare("UPDATE leads SET status='Contacted' WHERE id=?")->execute([$_GET['mark_contacted']]);
    flash("Lead marked as contacted.");
    redirect('leads.php');
}

$lead_count = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'New'")->fetchColumn();
$leads      = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC")->fetchAll();

adminHead("Leads");
adminSidebar("leads", (int)$lead_count);
?>

<div class="admin-topbar">
    <h1><i class="fas fa-bullhorn me-2" style="color:var(--gold);font-size:1rem;"></i> Lead Management</h1>
    <div style="display:flex;align-items:center;gap:12px;">
        <?php if ($lead_count > 0): ?>
        <span style="background:rgba(239,68,68,0.12);color:#EF4444;border:1px solid rgba(239,68,68,0.2);border-radius:50px;padding:4px 14px;font-size:0.82rem;font-weight:600;">
            <?php echo $lead_count; ?> New
        </span>
        <?php endif; ?>
    </div>
</div>

<div class="admin-content">
    <?php renderFlash(); ?>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <?php
        $total_leads     = count($leads);
        $contacted_leads = count(array_filter($leads, fn($l) => $l['status'] === 'Contacted'));
        $new_leads       = $total_leads - $contacted_leads;
        $conv_rate       = $total_leads > 0 ? round(($contacted_leads / $total_leads) * 100) : 0;
        ?>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-paper-plane"></i></div>
                <div><div class="stat-value"><?php echo $total_leads; ?></div><div class="stat-label">Total Leads</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon red"><i class="fas fa-bell"></i></div>
                <div><div class="stat-value"><?php echo $new_leads; ?></div><div class="stat-label">New Leads</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="fas fa-phone-check"></i></div>
                <div><div class="stat-value"><?php echo $contacted_leads; ?></div><div class="stat-label">Contacted</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon gold"><i class="fas fa-percent"></i></div>
                <div><div class="stat-value"><?php echo $conv_rate; ?>%</div><div class="stat-label">Contact Rate</div></div>
            </div>
        </div>
    </div>

    <!-- Leads Table -->
    <div class="a-card">
        <div class="a-card-header">
            <h5><i class="fas fa-list me-2" style="color:var(--gold);"></i> All Leads</h5>
        </div>
        <div style="overflow-x:auto;">
            <table class="a-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Goal / Enquiry</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($leads)): ?>
                    <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:40px;">
                        No leads yet. They'll appear when visitors submit the enquiry form on your website.
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td style="color:var(--text-muted);font-size:0.85rem;white-space:nowrap;">
                            <?php echo date('d M, Y', strtotime($lead['created_at'])); ?>
                        </td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($lead['name']); ?></td>
                        <td style="color:var(--text-muted);"><?php echo htmlspecialchars($lead['phone']); ?></td>
                        <td style="color:var(--text-muted);max-width:200px;"><?php echo htmlspecialchars($lead['goal']); ?></td>
                        <td>
                            <?php if ($lead['status'] === 'New'): ?>
                                <span class="badge-danger">🔔 New</span>
                            <?php else: ?>
                                <span class="badge-success">✓ Contacted</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2 align-items-center">
                                <?php if ($lead['status'] === 'New'): ?>
                                    <a href="leads.php?mark_contacted=<?php echo $lead['id']; ?>"
                                       class="btn-gold btn btn-sm" style="font-size:0.78rem;padding:6px 12px;">
                                        <i class="fas fa-check me-1"></i> Mark Contacted
                                    </a>
                                <?php else: ?>
                                    <span style="color:var(--text-muted);font-size:0.85rem;">
                                        <i class="fas fa-check-double me-1"></i> Done
                                    </span>
                                <?php endif; ?>
                                <a href="https://wa.me/91<?php echo $lead['phone']; ?>" target="_blank"
                                   class="btn-act btn-act-green" title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="tel:<?php echo $lead['phone']; ?>"
                                   class="btn-act btn-act-blue" title="Call">
                                    <i class="fas fa-phone"></i>
                                </a>
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

<?php adminEnd(); ?>
