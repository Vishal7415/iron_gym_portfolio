<?php
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    redirect('login.php');
}

$id = $_GET['id'] ?? null;
if (!$id) redirect('members.php');

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$m = $stmt->fetch();

if (!$m) die("Member not found.");

// Mark as sent in demo logic
$stmt = $pdo->prepare("UPDATE members SET diet_plan_sent = 1 WHERE id = ?");
$stmt->execute([$id]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan Demo - Ironman Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-darker-bg p-5">

<div class="container text-center">
    <div class="card p-5 mx-auto" style="max-width: 600px;">
        <h2 class="text-gold mb-4"><i class="fas fa-file-pdf me-2"></i> DIET PLAN GENERATED</h2>
        <p class="text-muted mb-4">A customized diet plan for <strong><?php echo $m['name']; ?></strong> has been generated based on their goal (<?php echo $m['plan_type']; ?>).</p>
        
        <div class="bg-dark p-4 rounded mb-4 text-start">
             <h6 class="text-gold">Preview:</h6>
             <ul class="text-light small">
                <li>Breakfast: 4 Egg whites + Oats</li>
                <li>Lunch: Grilled Chicken/Paneer + Brown Rice</li>
                <li>Evening: Fruits + Nuts</li>
                <li>Dinner: Fish/Soya + Green Salad</li>
             </ul>
        </div>

        <div class="d-grid gap-2">
            <a href="https://wa.me/91<?php echo $m['phone']; ?>?text=Hello <?php echo urlencode($m['name']); ?>, Your Ironman Gym Diet Plan is ready. Download here: [Link]" target="_blank" class="btn btn-gold py-3">
                <i class="fab fa-whatsapp me-2"></i> SEND VIA WHATSAPP (DEMO)
            </a>
            <a href="members.php" class="btn btn-outline-secondary mt-2">Back to Members</a>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
