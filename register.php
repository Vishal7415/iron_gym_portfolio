<?php
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: membership.php');
    exit;
}

$name     = trim($_POST['name'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');
$utr      = trim($_POST['utr'] ?? '');
$duration = (int)($_POST['duration'] ?? 1);

// Plan pricing
$plans = [
    1  => ['label' => '1 Month',  'fee' => 500],
    3  => ['label' => '3 Months', 'fee' => 1200],
    12 => ['label' => '1 Year',   'fee' => 4000],
];

// Validate all required fields
if (!$name || !$phone || !$utr || !isset($plans[$duration])) {
    header('Location: membership.php?error=invalid');
    exit;
}

// UTR must be 12 digits (standard UPI UTR format)
if (!preg_match('/^[0-9]{12}$/', $utr)) {
    header('Location: membership.php?error=utr');
    exit;
}

$plan  = $plans[$duration];
$fee   = $plan['fee'];
$label = $plan['label'];

$start_date  = date('Y-m-d');
$expiry_date = date('Y-m-d', strtotime("+$duration months"));

if (!$pdo) {
    die("Database not available. Please try again later.");
}

try {
    // Check for duplicate UTR
    $check = $pdo->prepare("SELECT id FROM members WHERE utr = ?");
    $check->execute([$utr]);
    if ($check->fetch()) {
        header('Location: membership.php?error=duplicate_utr');
        exit;
    }

    // Insert member with Pending status
    $stmt = $pdo->prepare("INSERT INTO members 
        (name, phone, email, plan_type, start_date, duration_months, expiry_date, fee, source, utr, payment_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Online', ?, 'Pending')");
    $stmt->execute([$name, $phone, $email, $label, $start_date, $duration, $expiry_date, $fee, $utr]);
    $member_id = $pdo->lastInsertId();

    // Generate invoice number
    $invoice_no = 'TFE-' . date('Y') . '-' . str_pad($member_id, 4, '0', STR_PAD_LEFT);

    // Insert invoice
    $stmt2 = $pdo->prepare("INSERT INTO invoices (invoice_no, member_id, amount) VALUES (?, ?, ?)");
    $stmt2->execute([$invoice_no, $member_id, $fee]);

    // Redirect to confirmation
    header("Location: confirmation.php?id=$member_id");
    exit;

} catch (PDOException $e) {
    die("Registration failed: " . $e->getMessage());
}
?>
