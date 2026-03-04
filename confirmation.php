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
            .invoice-box { max-width: 100%; box-shadow: none; border-radius: 0; padding: 0 !important; }
        .success-bg { background: radial-gradient(circle at top right, rgba(40,167,69,0.05), transparent 70%); }
    </style>
</head>
<body class="py-5 success-bg">

<div class="container" style="max-width:800px;">

    <!-- Status Banner -->
    <div class="card p-4 mb-4 text-center no-print" style="border-radius:24px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
        <div style="width:70px;height:70px;background:rgba(34,197,94,0.1);border:2px solid #22c55e;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
            <i class="fas fa-check fa-lg text-success"></i>
        </div>
        <h3 class="fw-bold mb-1">Registration Successful!</h3>
        <p class="text-muted small">Thank you for joining <strong class="text-gold"><?php echo GYM_NAME; ?></strong>.</p>
        
        <div class="mt-3 p-3 rounded-4 mx-auto" style="max-width:500px; background:rgba(212,175,55,0.05); border:1px solid rgba(212,175,55,0.15);">
            <div class="d-flex align-items-center justify-content-center gap-2 text-gold fw-bold small mb-1">
                <i class="fas fa-clock"></i> PAYMENT VERIFICATION PENDING
            </div>
            <p class="mb-0 x-small text-muted" style="font-size: 0.75rem;">
                Admin will verify UTR: <strong><?php echo htmlspecialchars($member['utr'] ?? ''); ?></strong><br>
                Your membership will be activated shortly.
            </p>
        </div>
    </div>

    <!-- Official Bill Card -->
    <div class="card overflow-hidden" style="border-radius:24px; box-shadow: 0 15px 50px rgba(0,0,0,0.3); border:none;">
        <div class="bg-gold py-2 text-center text-dark fw-bold x-small no-print" style="font-size: 0.7rem; letter-spacing: 2px;">
            OFFICIAL PAYMENT RECEIPT
        </div>
        <div class="p-5" id="invoicePrint" style="background:#fff; color:#1a1a1a;">
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <h2 style="color:var(--gold); font-weight: 800; margin:0; letter-spacing:-0.5px;"><?php echo strtoupper(GYM_NAME); ?></h2>
                    <p class="text-muted mb-0 small" style="max-width:250px;"><?php echo GYM_ADDRESS; ?></p>
                    <p class="text-muted mb-0 small">Phone: <?php echo GYM_PHONE; ?></p>
                </div>
                <div class="text-end">
                    <h4 class="fw-bold mb-1" style="color:#333;">BILL / RECEIPT</h4>
                    <p class="mb-0 small text-muted"><strong>No:</strong> <?php echo $invoice_no; ?></p>
                    <p class="mb-0 small text-muted"><strong>Date:</strong> <?php echo $created_fmt; ?></p>
                </div>
            </div>

            <div style="height:2px; background: linear-gradient(90deg, var(--gold), transparent); margin-bottom: 40px; border-radius: 2px;"></div>

            <!-- Client & Details -->
            <div class="row mb-5">
                <div class="col-6">
                    <p class="text-uppercase small fw-bold text-muted mb-2" style="letter-spacing:1px; font-size:0.65rem;">Billed To</p>
                    <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($member['name']); ?></h5>
                    <p class="mb-0 small text-muted">Tel: <?php echo htmlspecialchars($member['phone']); ?></p>
                    <?php if(!empty($member['email'])): ?>
                    <p class="mb-0 small text-muted"><?php echo htmlspecialchars($member['email']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-6 text-end">
                    <p class="text-uppercase small fw-bold text-muted mb-2" style="letter-spacing:1px; font-size:0.65rem;">Membership Details</p>
                    <p class="mb-1 small"><strong>Plan:</strong> <?php echo htmlspecialchars($member['plan_type']); ?></p>
                    <p class="mb-1 small text-muted">Duration: <?php echo $member['duration_months']; ?> Month<?php echo $member['duration_months']>1?'s':''; ?></p>
                    <p class="mb-0 small text-muted">Validity: <?php echo $start_fmt; ?> — <?php echo $expiry_fmt; ?></p>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-borderless mb-5">
                <thead>
                    <tr style="border-bottom: 2px solid #f0f0f0;">
                        <th class="py-3 text-muted small text-uppercase" style="letter-spacing:1px; font-size:0.65rem;">Description</th>
                        <th class="py-3 text-end text-muted small text-uppercase" style="letter-spacing:1px; font-size:0.65rem;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td class="py-4">
                            <span class="fw-bold d-block"><?php echo htmlspecialchars($member['plan_type']); ?> Membership</span>
                            <small class="text-muted">New Registration - Online Payment</small>
                        </td>
                        <td class="py-4 text-end fw-bold">₹<?php echo number_format($member['fee'], 2); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="pt-4 fw-bold fs-5">Total Paid</td>
                        <td class="pt-4 text-end fw-bold fs-4 text-gold" style="color:var(--gold) !important;">₹<?php echo number_format($member['fee'], 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-center mt-5 pt-4" style="border-top: 1px dashed #eee;">
                <p class="small fw-bold mb-1" style="color:#555;">Payment Source: UPI (UTR: <?php echo htmlspecialchars($member['utr']); ?>)</p>
                <p class="text-muted x-small mb-0">This is a system-generated document and acts as a valid receipt for your gym membership.</p>
                <div class="mt-2 text-gold fw-bold" style="font-size:0.9rem;">The Fitness Empire — Build Your Legacy</div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="text-center mt-5 no-print d-flex gap-3 justify-content-center flex-wrap">
        <button onclick="window.print()" class="btn btn-gold px-5 py-3 rounded-pill shadow-lg">
            <i class="fas fa-file-pdf me-2"></i> DOWNLOAD BILL
        </button>
        <a href="https://wa.me/91<?php echo GYM_PHONE; ?>?text=Hello!%20I've%20paid%20for%20<?php echo urlencode($member['plan_type']); ?>%20membership.%20My%20UTR%20is%20<?php echo htmlspecialchars($member['utr']); ?>.%20Please%20verify." 
           target="_blank" class="btn btn-dark border border-secondary px-5 py-3 rounded-pill">
            <i class="fab fa-whatsapp me-2 text-success"></i> SEND ON WHATSAPP
        </a>
        <a href="index.php" class="btn btn-link text-muted text-decoration-none mt-2 w-100">
            <i class="fas fa-arrow-left me-1"></i> Return to Homepage
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
