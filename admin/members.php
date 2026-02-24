<?php
require_once __DIR__ . '/admin_layout.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

$action = $_GET['action'] ?? 'list';
$id     = $_GET['id'] ?? null;
$lead_count = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'New'")->fetchColumn();

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_member']) || isset($_POST['edit_member'])) {
        $name       = trim($_POST['name']);
        $phone      = trim($_POST['phone']);
        $plan_type  = $_POST['plan_type'];
        $start_date = $_POST['start_date'];
        $duration   = (int)$_POST['duration'];
        $fee        = (float)$_POST['fee'];
        $expiry_date = date('Y-m-d', strtotime("+{$duration} months", strtotime($start_date)));

        if (isset($_POST['add_member'])) {
            $pdo->prepare("INSERT INTO members (name, phone, plan_type, start_date, duration_months, expiry_date, fee) VALUES (?, ?, ?, ?, ?, ?, ?)")
                ->execute([$name, $phone, $plan_type, $start_date, $duration, $expiry_date, $fee]);
            flash("Member added successfully!");
        } else {
            $pdo->prepare("UPDATE members SET name=?, phone=?, plan_type=?, start_date=?, duration_months=?, expiry_date=?, fee=? WHERE id=?")
                ->execute([$name, $phone, $plan_type, $start_date, $duration, $expiry_date, $fee, $id]);
            flash("Member updated successfully!");
        }
        redirect('members.php');
    }
}

if ($action === 'delete' && $id) {
    $pdo->prepare("DELETE FROM members WHERE id=?")->execute([$id]);
    flash("Member deleted.", "warning");
    redirect('members.php');
}
if ($action === 'verify_payment' && $id) {
    $pdo->prepare("UPDATE members SET payment_status='Verified' WHERE id=?")->execute([$id]);
    flash("Payment verified! ✅");
    redirect('members.php');
}
if ($action === 'reject_payment' && $id) {
    $pdo->prepare("UPDATE members SET payment_status='Rejected' WHERE id=?")->execute([$id]);
    flash("Payment rejected. ❌", "danger");
    redirect('members.php');
}

// Fetch for edit
$member = null;
if ($action === 'edit' && $id) {
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch();
}

// Search & List
$search = $_GET['search'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM members WHERE name LIKE ? OR phone LIKE ? ORDER BY created_at DESC");
$stmt->execute(["%$search%", "%$search%"]);
$members = $stmt->fetchAll();

$pageTitle = match($action) {
    'add'  => 'Add New Member',
    'edit' => 'Edit Member',
    default => 'Member Management',
};

adminHead($pageTitle);
adminSidebar("members", (int)$lead_count);
?>

<div class="admin-topbar">
    <h1><i class="fas fa-users me-2" style="color:var(--gold);font-size:1rem;"></i> <?php echo $pageTitle; ?></h1>
    <?php if ($action === 'list'): ?>
        <a href="members.php?action=add" class="btn-gold btn"><i class="fas fa-plus me-2"></i> Add Member</a>
    <?php else: ?>
        <a href="members.php" class="btn-outline-gold btn"><i class="fas fa-arrow-left me-2"></i> Back to List</a>
    <?php endif; ?>
</div>

<div class="admin-content">
    <?php renderFlash(); ?>

    <?php if ($action === 'add' || $action === 'edit'): ?>
    <!-- Add / Edit Form -->
    <div class="a-card">
        <div class="a-card-header">
            <h5><i class="fas fa-user-edit me-2" style="color:var(--gold);"></i> <?php echo $pageTitle; ?></h5>
        </div>
        <div class="a-card-body">
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Member's full name"
                               value="<?php echo htmlspecialchars($member['name'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" required placeholder="10-digit mobile number"
                               value="<?php echo htmlspecialchars($member['phone'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Plan Type</label>
                        <select name="plan_type" class="form-select">
                            <?php $pt = $member['plan_type'] ?? ''; ?>
                            <option value="General Training"  <?php echo $pt==='General Training'  ? 'selected':''; ?>>General Training</option>
                            <option value="Personal Training" <?php echo $pt==='Personal Training' ? 'selected':''; ?>>Personal Training</option>
                            <option value="Cardio & Weight"  <?php echo $pt==='Cardio & Weight'   ? 'selected':''; ?>>Cardio & Weight</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required
                               value="<?php echo $member['start_date'] ?? date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Duration</label>
                        <select name="duration" class="form-select">
                            <?php $dur = $member['duration_months'] ?? ''; ?>
                            <option value="1"  <?php echo $dur==1  ? 'selected':''; ?>>1 Month</option>
                            <option value="3"  <?php echo $dur==3  ? 'selected':''; ?>>3 Months</option>
                            <option value="6"  <?php echo $dur==6  ? 'selected':''; ?>>6 Months</option>
                            <option value="12" <?php echo $dur==12 ? 'selected':''; ?>>12 Months</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Fee Charged (₹)</label>
                        <input type="number" name="fee" class="form-control" required placeholder="e.g. 1500"
                               value="<?php echo $member['fee'] ?? ''; ?>">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" name="<?php echo $action === 'add' ? 'add_member' : 'edit_member'; ?>" class="btn-gold btn px-5">
                        <i class="fas fa-save me-2"></i> <?php echo $action === 'add' ? 'Save Member' : 'Update Member'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php else: ?>
    <!-- Search -->
    <div class="a-card mb-3">
        <div class="a-card-body" style="padding:16px 20px;">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or phone number…"
                       value="<?php echo htmlspecialchars($search); ?>" style="flex:1;">
                <button type="submit" class="btn-gold btn px-4"><i class="fas fa-search me-2"></i> Search</button>
                <?php if ($search): ?>
                    <a href="members.php" class="btn-outline-gold btn px-3">Clear</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Members Table -->
    <div class="a-card">
        <div class="a-card-header">
            <h5><i class="fas fa-list me-2" style="color:var(--gold);"></i>
                All Members
                <span style="background:rgba(212,175,55,0.15);color:var(--gold);border-radius:50px;padding:2px 10px;font-size:0.75rem;margin-left:8px;"><?php echo count($members); ?></span>
            </h5>
        </div>
        <div style="overflow-x:auto;">
            <table class="a-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Plan</th>
                        <th>Expiry</th>
                        <th>Source</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($members)): ?>
                    <tr><td colspan="9" style="text-align:center;color:var(--text-muted);padding:40px;">
                        <?php echo $search ? 'No members found matching "'.htmlspecialchars($search).'".' : 'No members yet. Add one to get started.'; ?>
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($members as $m):
                        $is_expired = strtotime($m['expiry_date']) < time();
                        $pay_status = $m['payment_status'] ?? 'Verified';
                        $utr        = $m['utr'] ?? '';
                        $source     = $m['source'] ?? 'Admin';
                    ?>
                    <tr>
                        <td style="color:var(--text-muted);font-size:0.8rem;">#<?php echo $m['id']; ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($m['name']); ?></td>
                        <td style="color:var(--text-muted);"><?php echo htmlspecialchars($m['phone']); ?></td>
                        <td style="color:var(--text-muted);font-size:0.85rem;"><?php echo htmlspecialchars($m['plan_type']); ?></td>
                        <td style="color:<?php echo $is_expired ? '#EF4444':'var(--text-muted)'; ?>;font-size:0.88rem;">
                            <?php echo date('d M, Y', strtotime($m['expiry_date'])); ?>
                        </td>
                        <td>
                            <?php if($source === 'Online'): ?>
                                <span class="badge-info">🌐 Online</span>
                            <?php else: ?>
                                <span class="badge-secondary">Admin</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($pay_status === 'Pending'): ?>
                                <span class="badge-warning">⏳ Pending</span>
                                <?php if($utr): ?><br><small style="color:var(--text-muted);font-size:0.72rem;">UTR: <?php echo htmlspecialchars($utr); ?></small><?php endif; ?>
                            <?php elseif($pay_status === 'Rejected'): ?>
                                <span class="badge-danger">❌ Rejected</span>
                            <?php else: ?>
                                <span class="badge-success">✅ Verified</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $is_expired ? '<span class="badge-danger">Expired</span>' : '<span class="badge-success">Active</span>'; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <?php if($pay_status === 'Pending'): ?>
                                    <a href="members.php?action=verify_payment&id=<?php echo $m['id']; ?>" class="btn-act btn-act-green" title="Verify Payment" onclick="return confirm('Verify this payment?')"><i class="fas fa-check"></i></a>
                                    <a href="members.php?action=reject_payment&id=<?php echo $m['id']; ?>" class="btn-act btn-act-red" title="Reject Payment" onclick="return confirm('Reject this payment?')"><i class="fas fa-times"></i></a>
                                <?php endif; ?>
                                <a href="invoice.php?id=<?php echo $m['id']; ?>" class="btn-act btn-act-blue" title="Print Invoice"><i class="fas fa-file-invoice"></i></a>
                                <a href="diet_demo.php?id=<?php echo $m['id']; ?>" class="btn-act btn-act-green" title="Diet Plan"><i class="fas fa-apple-alt"></i></a>
                                <a href="members.php?action=edit&id=<?php echo $m['id']; ?>" class="btn-act btn-act-gold" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="members.php?action=delete&id=<?php echo $m['id']; ?>" class="btn-act btn-act-red" title="Delete" onclick="return confirm('Delete this member permanently?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php adminEnd(); ?>
