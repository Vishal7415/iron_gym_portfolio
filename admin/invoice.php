<?php
require_once __DIR__ . '/../includes/db.php';

if (!admin_is_logged_in()) {
    redirect('login.php');
}

$id = $_GET['id'] ?? null;
if (!$id) redirect('members.php');

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();
if (!$member) die("Member not found.");

$invoice_id = "TFE-" . date('Y') . "-" . str_pad($member['id'], 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice <?php echo $invoice_id; ?> — <?php echo GYM_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background: #f5f5f0; font-family: 'Outfit', sans-serif; color: #1a1a1a; }
        .invoice-wrap { max-width: 760px; margin: 40px auto; }

        .no-print { text-align: center; margin-bottom: 28px; }
        .no-print .btn { display: inline-flex; align-items: center; gap: 8px; font-weight: 600; border-radius: 10px; padding: 10px 24px; font-size: 0.9rem; text-decoration:none; }
        .btn-print { background: #D4AF37; color: #0a0a0a; border: none; }
        .btn-print:hover { background: #B8860B; color: #fff; }
        .btn-back  { background: transparent; color: #555; border: 1px solid #ddd; margin-left: 8px; }
        .btn-back:hover  { background: #f0f0f0; color: #333; }

        .invoice-box {
            background: #fff;
            border-radius: 16px;
            padding: 44px 48px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
        }

        .inv-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 36px; }
        .inv-brand h2 { color: #D4AF37; font-weight: 800; font-size: 1.6rem; margin: 0; }
        .inv-brand p  { color: #777; font-size: 0.85rem; margin: 4px 0 0; }
        .inv-meta     { text-align: right; font-size: 0.9rem; }
        .inv-meta .inv-num { font-size: 1.1rem; font-weight: 700; color: #1a1a1a; }
        .inv-meta p   { color: #777; margin: 3px 0; font-size: 0.83rem; }

        .inv-divider { height: 2px; background: linear-gradient(90deg, #D4AF37, transparent); margin: 0 0 28px; border-radius: 2px; }

        .inv-parties { display: flex; justify-content: space-between; margin-bottom: 36px; }
        .inv-party h6 { font-size: 0.72rem; letter-spacing: 2px; text-transform: uppercase; color: #aaa; font-weight: 600; margin-bottom: 8px; }
        .inv-party p  { margin: 0; font-size: 0.9rem; color: #333; line-height: 1.7; }
        .inv-party strong { color: #1a1a1a; font-size: 1rem; }

        .inv-table { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
        .inv-table thead th { border-bottom: 2px solid #eee; padding: 10px 0; font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase; color: #aaa; font-weight: 600; }
        .inv-table tbody td { padding: 18px 0; border-bottom: 1px solid #f0f0f0; vertical-align: top; }
        .inv-table .item-name  { font-weight: 600; color: #1a1a1a; }
        .inv-table .item-sub   { font-size: 0.83rem; color: #888; margin-top: 4px; }
        .inv-table .text-end   { text-align: right; font-weight: 700; color: #1a1a1a; font-size: 1.05rem; }

        .inv-total { text-align: right; padding: 16px 0; }
        .inv-total .label { font-size: 0.85rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
        .inv-total .amount { font-size: 2rem; font-weight: 800; color: #D4AF37; }

        .inv-footer { margin-top: 36px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; }
        .inv-footer p { color: #aaa; font-size: 0.82rem; margin: 0; }

        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .invoice-wrap { margin: 0; }
            .invoice-box { box-shadow: none; border-radius: 0; }
        }
    </style>
</head>
<body>

<div class="invoice-wrap">
    <div class="no-print">
        <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Print / Save PDF</button>
        <a href="members.php" class="btn btn-back">← Back to Members</a>
    </div>

    <div class="invoice-box">
        <div class="inv-header">
            <div class="inv-brand">
                <h2><?php echo strtoupper(GYM_NAME); ?></h2>
                <p><?php echo GYM_ADDRESS; ?><br>📞 <?php echo GYM_PHONE; ?></p>
            </div>
            <div class="inv-meta">
                <div class="inv-num">INVOICE</div>
                <p># <?php echo $invoice_id; ?></p>
                <p>Date: <?php echo date('d M, Y', strtotime($member['created_at'])); ?></p>
                <p style="color:#22C55E;font-weight:700;">● PAID</p>
            </div>
        </div>

        <div class="inv-divider"></div>

        <div class="inv-parties">
            <div class="inv-party">
                <h6>From</h6>
                <strong><?php echo GYM_NAME; ?></strong>
                <p><?php echo GYM_ADDRESS; ?><br>Phone: <?php echo GYM_PHONE; ?></p>
            </div>
            <div class="inv-party" style="text-align:right;">
                <h6>Bill To</h6>
                <strong><?php echo htmlspecialchars($member['name']); ?></strong>
                <p>Phone: <?php echo htmlspecialchars($member['phone']); ?></p>
            </div>
        </div>

        <table class="inv-table">
            <thead>
                <tr>
                    <th style="width:70%;">Description</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="item-name"><?php echo htmlspecialchars($member['plan_type']); ?> Membership</div>
                        <div class="item-sub">
                            Duration: <?php echo $member['duration_months']; ?> Month<?php echo $member['duration_months'] > 1 ? 's' : ''; ?> &nbsp;|&nbsp;
                            Start: <?php echo date('d M, Y', strtotime($member['start_date'])); ?> &nbsp;|&nbsp;
                            Expiry: <?php echo date('d M, Y', strtotime($member['expiry_date'])); ?>
                        </div>
                    </td>
                    <td class="text-end">₹<?php echo number_format($member['fee'], 2); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="inv-total">
            <div class="label">Total Amount</div>
            <div class="amount">₹<?php echo number_format($member['fee'], 2); ?></div>
        </div>

        <div class="inv-footer">
            <p>Thank you for being a valued member of <strong><?php echo GYM_NAME; ?></strong>! 💪<br>
            This is a computer-generated invoice and does not require a physical signature.</p>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
