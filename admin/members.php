<?php
require_once __DIR__ . '/../includes/db.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Handle Actions (Add, Edit, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_member']) || isset($_POST['edit_member'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $plan_type = $_POST['plan_type'];
        $start_date = $_POST['start_date'];
        $duration = (int)$_POST['duration'];
        $fee = (float)$_POST['fee'];
        
        // Auto Calculate Expiry Date
        $expiry_date = date('Y-m-d', strtotime("+$duration months", strtotime($start_date)));

        if (isset($_POST['add_member'])) {
            $stmt = $pdo->prepare("INSERT INTO members (name, phone, plan_type, start_date, duration_months, expiry_date, fee) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $plan_type, $start_date, $duration, $expiry_date, $fee]);
            flash("Member added successfully!");
        } else {
            $stmt = $pdo->prepare("UPDATE members SET name = ?, phone = ?, plan_type = ?, start_date = ?, duration_months = ?, expiry_date = ?, fee = ? WHERE id = ?");
            $stmt->execute([$name, $phone, $plan_type, $start_date, $duration, $expiry_date, $fee, $id]);
            flash("Member updated successfully!");
        }
        redirect('members.php');
    }
}

if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
    $stmt->execute([$id]);
    flash("Member deleted successfully.", "warning");
    redirect('members.php');
}

// Fetch member for edit
$member = null;
if ($action === 'edit' && $id) {
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch();
}

// Search & List
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM members WHERE name LIKE ? OR phone LIKE ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute(["%$search%", "%$search%"]);
$members = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management - Ironman Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>:root{--gold:#D4AF37;--dark-gold:#B8860B;--dark-bg:#121212;--darker-bg:#0a0a0a;--light-text:#e0e0e0;--muted-text:#888;}body{background:var(--dark-bg);color:var(--light-text);font-family:Inter,sans-serif;}.bg-darker-bg{background-color:var(--darker-bg)!important}.card{background:var(--darker-bg);border:1px solid #333;}.text-gold{color:var(--gold)!important}.btn-gold{background:var(--gold);color:var(--darker-bg);font-weight:bold;border:none}.btn-gold:hover{background:var(--dark-gold);color:white}.btn-outline-gold{border:1px solid var(--gold);color:var(--gold)}.btn-outline-gold:hover{background:var(--gold);color:var(--darker-bg)}.text-muted{color:var(--muted-text)!important}.table{color:var(--light-text)}.form-control{background:#222;border:1px solid #444;color:white}.form-control:focus{background:#2a2a2a;border-color:var(--gold);color:white;box-shadow:0 0 0 .25rem rgba(212,175,55,.25)}.section-title{color:var(--gold);text-transform:uppercase;font-weight:700}</style>
</head>
<body class="bg-darker-bg">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar placeholder or Include -->
        <div class="col-md-2 d-none d-md-block bg-dark p-0 position-fixed" style="min-height: 100vh;">
             <div class="p-4"><h4 class="text-gold fw-bold">IRONMAN</h4></div>
             <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link py-3 px-4 text-light" href="index.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-gold active bg-dark-gold text-dark" href="members.php"><i class="fas fa-users me-2"></i> Members</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-light" href="leads.php"><i class="fas fa-bullhorn me-2"></i> Leads</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
             </ul>
        </div>

        <div class="col-md-10 offset-md-2 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Member Management</h2>
                <?php if ($action === 'list'): ?>
                    <a href="members.php?action=add" class="btn btn-gold">ADD NEW MEMBER</a>
                <?php else: ?>
                    <a href="members.php" class="btn btn-outline-gold">BACK TO LIST</a>
                <?php endif; ?>
            </div>

            <?php if ($flash = get_flash()): ?>
                <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></div>
            <?php endif; ?>

            <?php if ($action === 'add' || $action === 'edit'): ?>
                <div class="card p-4">
                    <h4 class="text-gold mb-4"><?php echo $action === 'add' ? 'Add New Member' : 'Edit Member'; ?></h4>
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required value="<?php echo $member['name'] ?? ''; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" required value="<?php echo $member['phone'] ?? ''; ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Plan Type</label>
                                <select name="plan_type" class="form-select bg-dark text-light border-secondary">
                                    <option value="General Training" <?php echo ($member['plan_type'] ?? '') === 'General Training' ? 'selected' : ''; ?>>General Training</option>
                                    <option value="Personal Training" <?php echo ($member['plan_type'] ?? '') === 'Personal Training' ? 'selected' : ''; ?>>Personal Training</option>
                                    <option value="Cardio & Weight" <?php echo ($member['plan_type'] ?? '') === 'Cardio & Weight' ? 'selected' : ''; ?>>Cardio & Weight</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required value="<?php echo $member['start_date'] ?? date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Duration (Months)</label>
                                <select name="duration" class="form-select bg-dark text-light border-secondary">
                                    <option value="1" <?php echo ($member['duration_months'] ?? '') == 1 ? 'selected' : ''; ?>>1 Month</option>
                                    <option value="3" <?php echo ($member['duration_months'] ?? '') == 3 ? 'selected' : ''; ?>>3 Months</option>
                                    <option value="6" <?php echo ($member['duration_months'] ?? '') == 6 ? 'selected' : ''; ?>>6 Months</option>
                                    <option value="12" <?php echo ($member['duration_months'] ?? '') == 12 ? 'selected' : ''; ?>>12 Months</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Fee Charged (₹)</label>
                                <input type="number" name="fee" class="form-control" required value="<?php echo $member['fee'] ?? ''; ?>">
                            </div>
                        </div>
                        <button type="submit" name="<?php echo $action === 'add' ? 'add_member' : 'edit_member'; ?>" class="btn btn-gold px-5 py-3 mt-3">SAVED MEMBER DETAILS</button>
                    </form>
                </div>
            <?php else: ?>
                <!-- Search Box -->
                <div class="card mb-4 p-3">
                    <form method="GET" class="row g-2">
                        <div class="col-md-10">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or phone..." value="<?php echo $search; ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-gold w-100">SEARCH</button>
                        </div>
                    </form>
                </div>

                <!-- Members Table -->
                <div class="card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Plan</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($members as $m): ?>
                                <?php 
                                    $is_expired = strtotime($m['expiry_date']) < time();
                                ?>
                                <tr>
                                    <td>#<?php echo $m['id']; ?></td>
                                    <td class="fw-bold"><?php echo $m['name']; ?></td>
                                    <td><?php echo $m['phone']; ?></td>
                                    <td><?php echo $m['plan_type']; ?></td>
                                    <td class="<?php echo $is_expired ? 'text-danger fw-bold' : ''; ?>">
                                        <?php echo date('d M, Y', strtotime($m['expiry_date'])); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo $is_expired ? 'danger' : 'success'; ?>">
                                            <?php echo $is_expired ? 'Expired' : 'Active'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="invoice.php?id=<?php echo $m['id']; ?>" class="btn btn-outline-info" title="Print Invoice"><i class="fas fa-file-invoice"></i></a>
                                            <a href="diet_demo.php?id=<?php echo $m['id']; ?>" class="btn btn-outline-success" title="Send Diet Plan"><i class="fas fa-apple-alt"></i></a>
                                            <a href="members.php?action=edit&id=<?php echo $m['id']; ?>" class="btn btn-outline-gold"><i class="fas fa-edit"></i></a>
                                            <a href="members.php?action=delete&id=<?php echo $m['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
