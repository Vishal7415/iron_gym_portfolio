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

// Mock Invoice ID
$invoice_id = "INV-" . date('Y') . "-" . str_pad($member['id'], 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #<?php echo $invoice_id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: white; color: black; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            background: #fff;
        }
        .text-gold { color: #D4AF37 !important; }
        @media print {
            .no-print { display: none; }
            .invoice-box { box-shadow: none; border: none; }
        }
    </style>
</head>
<body class="bg-light py-5">

<div class="no-print text-center mb-4">
    <button onclick="window.print()" class="btn btn-gold px-4"><i class="fas fa-print me-2"></i> PRINT INVOICE</button>
    <a href="members.php" class="btn btn-outline-dark ms-2">Back to Members</a>
</div>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" class="w-100">
        <tr class="top">
            <td colspan="2">
                <table class="w-100">
                    <tr>
                        <td class="title">
                            <h2 class="text-gold fw-bold mb-0">IRONMAN GYM</h2>
                            <small class="text-muted"><?php echo GYM_NAME; ?></small>
                        </td>
                        <td class="text-end">
                            <strong>Invoice #:</strong> <?php echo $invoice_id; ?><br>
                            <strong>Created:</strong> <?php echo date('d M, Y', strtotime($member['created_at'])); ?><br>
                            <strong>Due:</strong> PAID
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2" class="pt-4 pb-4">
                <table class="w-100">
                    <tr>
                        <td>
                            <strong>GYM LOCATION:</strong><br>
                            <?php echo GYM_ADDRESS; ?><br>
                            Phone: <?php echo GYM_PHONE; ?>
                        </td>
                        <td class="text-end">
                            <strong>BILL TO:</strong><br>
                            <?php echo $member['name']; ?><br>
                            Phone: <?php echo $member['phone']; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading bg-light border-top border-bottom">
            <td class="p-2 fw-bold">Plan Description</td>
            <td class="p-2 text-end fw-bold">Amount</td>
        </tr>

        <tr class="item border-bottom">
            <td class="p-2">
                <?php echo $member['plan_type']; ?> Membership (<?php echo $member['duration_months']; ?> Months)<br>
                <small class="text-muted">Start Date: <?php echo $member['start_date']; ?> | Expiry: <?php echo $member['expiry_date']; ?></small>
            </td>
            <td class="p-2 text-end">₹<?php echo number_format($member['fee'], 2); ?></td>
        </tr>

        <tr class="total">
            <td></td>
            <td class="pt-4 text-end">
               <h4 class="fw-bold">Total: ₹<?php echo number_format($member['fee'], 2); ?></h4>
            </td>
        </tr>
    </table>
    
    <div class="mt-5 text-center">
        <hr>
        <p class="mb-1">Thank you for being part of the Ironman Family!</p>
        <small class="text-muted">This is a computer generated invoice and does not require a physical signature.</small>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
