<?php
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    redirect('login.php');
}

if (isset($_GET['mark_contacted'])) {
    $id = $_GET['mark_contacted'];
    $stmt = $pdo->prepare("UPDATE leads SET status = 'Contacted' WHERE id = ?");
    $stmt->execute([$id]);
    flash("Lead marked as contacted.");
    redirect('leads.php');
}

$leads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Management - Ironman Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-darker-bg">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar placeholder -->
        <div class="col-md-2 d-none d-md-block bg-dark p-0 position-fixed" style="min-height: 100vh;">
             <div class="p-4"><h4 class="text-gold fw-bold">IRONMAN</h4></div>
             <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link py-3 px-4 text-light" href="index.php"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-light" href="members.php"><i class="fas fa-users me-2"></i> Members</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-gold active bg-dark-gold text-dark" href="leads.php"><i class="fas fa-bullhorn me-2"></i> Leads</a></li>
                <li class="nav-item"><a class="nav-link py-3 px-4 text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
             </ul>
        </div>

        <div class="col-md-10 offset-md-2 p-4">
            <h2 class="fw-bold mb-4">Lead Collection Dashboard</h2>

            <?php if ($flash = get_flash()): ?>
                <div class="alert alert-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></div>
            <?php endif; ?>

            <div class="card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
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
                            <?php foreach ($leads as $lead): ?>
                            <tr>
                                <td><?php echo date('d M, Y', strtotime($lead['created_at'])); ?></td>
                                <td class="fw-bold"><?php echo $lead['name']; ?></td>
                                <td><?php echo $lead['phone']; ?></td>
                                <td><?php echo $lead['goal']; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $lead['status'] === 'New' ? 'danger' : 'success'; ?>">
                                        <?php echo $lead['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($lead['status'] === 'New'): ?>
                                        <a href="leads.php?mark_contacted=<?php echo $lead['id']; ?>" class="btn btn-sm btn-gold">MARK CONTACTED</a>
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fas fa-check-double me-1"></i> Contacted</span>
                                    <?php endif; ?>
                                    <a href="https://wa.me/91<?php echo $lead['phone']; ?>" target="_blank" class="btn btn-sm btn-outline-success ms-2"><i class="fab fa-whatsapp"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
