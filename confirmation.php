<?php
require_once __DIR__ . '/includes/db.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id || !$pdo) {
    header('Location: membership.php');
    exit;
}

$stmt = $pdo->prepare("SELECT m.*, i.invoice_no FROM members m LEFT JOIN invoices i ON i.member_id = m.id WHERE m.id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if (!$member) {
    header('Location: membership.php');
    exit;
}

$invoice_no   = $member['invoice_no'] ?? ('TFE-' . date('Y') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT));
$expiry_fmt   = date('d M, Y', strtotime($member['expiry_date']));
$start_fmt    = date('d M, Y', strtotime($member['start_date']));
$created_fmt  = date('d M, Y, h:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmed — <?php echo GYM_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --gold:#D4AF37; --dark-bg:#121212; --darker-bg:#0a0a0a; }
        body { background: var(--dark-bg); font-family: 'Inter', sans-serif; color: #e0e0e0; }
        .text-gold { color: var(--gold) !important; }
        .bg-gold    { background: var(--gold) !important; }
        .btn-gold   { background: var(--gold); color: #000; font-weight: 700; border: none; }
        .btn-gold:hover { background: #B8860B; color: #fff; }
        .card       { background: var(--darker-bg); border: 1px solid #333; }
        .success-icon { width:80px; height:80px; background:rgba(40,167,69,0.15);
                        border:3px solid #28a745; border-radius:50%; display:flex;
                        align-items:center; justify-content:center; margin:0 auto 1.5rem; }
        /* Print styles */
        @media print {
            .no-print { display: none !important; }
            body { background: #fff; color: #000; }
            .card { background: #fff; border: 1px solid #ccc; }
            .invoice-box { max-width: 100%; box-shadow: none; }
        }
    </style>
</head>
<body class="py-5">

<div class="container" style="max-width:760px;">

    <!-- Pending Verification Banner -->
    <div class="card p-4 mb-4 text-center no-print">
        <div style="width:80px;height:80px;background:rgba(255,193,7,0.15);border:3px solid #ffc107;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
            <i class="fas fa-clock fa-2x text-warning"></i>
        </div>
        <h2 class="text-warning fw-bold mb-1">Registration Received ⏳</h2>
        <p class="text-muted mb-2">Welcome to <strong class="text-gold"><?php echo GYM_NAME; ?></strong>!</p>
        <div class="alert py-2 mx-auto" style="max-width:500px;background:rgba(255,193,7,0.1);border:1px solid #ffc107;color:#ffc107;">
            <i class="fas fa-shield-alt me-1"></i> <strong>Payment Verification Pending</strong><br>
            <small class="text-muted">Your UTR: <strong class="text-light"><?php echo htmlspecialchars($member['utr'] ?? ''); ?></strong> — Admin will verify your payment. Membership activates after verification.</small>
        </div>
    </div>

    <!-- Invoice Card -->
    <div class="card p-4 invoice-box" id="invoicePrint">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h3 class="text-gold fw-bold mb-0"><i class="fas fa-dumbbell me-2"></i><?php echo strtoupper(GYM_NAME); ?></h3>
                <small class="text-muted"><?php echo GYM_ADDRESS; ?></small><br>
                <small class="text-muted">📞 <?php echo GYM_PHONE; ?></small>
            </div>
            <div class="text-end">
                <h5 class="fw-bold text-gold mb-1">RECEIPT</h5>
                <p class="mb-0 small"><strong>Invoice #:</strong> <?php echo $invoice_no; ?></p>
                <p class="mb-0 small"><strong>Date:</strong> <?php echo $created_fmt; ?></p>
                <span class="badge bg-warning text-dark mt-1">PENDING VERIFICATION</span>
            </div>
        </div>

        <hr style="border-color:#333;">

        <!-- Member Info -->
        <div class="row mb-4">
            <div class="col-6">
                <p class="text-muted small mb-1">BILLED TO</p>
                <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($member['name']); ?></h5>
                <p class="mb-0 small">📞 <?php echo htmlspecialchars($member['phone']); ?></p>
                <?php if(!empty($member['email'])): ?>
                <p class="mb-0 small">📧 <?php echo htmlspecialchars($member['email']); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-6 text-end">
                <p class="text-muted small mb-1">MEMBERSHIP DETAILS</p>
                <p class="mb-0 small"><strong>Plan:</strong> <?php echo htmlspecialchars($member['plan_type']); ?></p>
                <p class="mb-0 small"><strong>Start:</strong> <?php echo $start_fmt; ?></p>
                <p class="mb-0 small"><strong>Valid Till:</strong> <?php echo $expiry_fmt; ?></p>
            </div>
        </div>

        <!-- Amount Table -->
        <table class="table table-borderless mb-0" style="color:#e0e0e0;">
            <thead style="background:#1a1a1a; border-radius:4px;">
                <tr>
                    <th class="py-2 ps-3">Description</th>
                    <th class="py-2 text-end pe-3">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-3 ps-3">
                        <?php echo htmlspecialchars($member['plan_type']); ?> Membership<br>
                        <small class="text-muted"><?php echo $start_fmt; ?> — <?php echo $expiry_fmt; ?></small>
                    </td>
                    <td class="py-3 text-end pe-3 fw-bold">₹<?php echo number_format($member['fee'], 2); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="border-top: 2px solid var(--gold);">
                    <td class="ps-3 fw-bold text-gold fs-5">TOTAL</td>
                    <td class="pe-3 fw-bold text-gold text-end fs-4">₹<?php echo number_format($member['fee'], 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center mt-4 pt-3" style="border-top:1px solid #333;">
            <p class="text-muted small mb-0">Thank you for joining The Fitness Empire! See you at the gym 💪</p>
            <small class="text-muted">This is a computer generated receipt. No signature required.</small>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-4 no-print d-flex gap-3 justify-content-center flex-wrap">
        <button onclick="window.print()" class="btn btn-gold px-5 py-3 fw-bold">
            <i class="fas fa-print me-2"></i> Print / Download Bill
        </button>
        <a href="membership.php" class="btn btn-outline-light px-5 py-3">
            <i class="fas fa-home me-2"></i> Back to Home
        </a>
        <a href="https://wa.me/91<?php echo GYM_PHONE; ?>?text=Hi!%20I%20just%20registered%20for%20<?php echo urlencode($member['plan_type']); ?>%20plan%20(Invoice%20<?php echo $invoice_no; ?>)" 
           target="_blank" class="btn py-3 px-5 fw-bold" style="background:#25d366;color:#fff;">
            <i class="fab fa-whatsapp me-2"></i> Share on WhatsApp
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
