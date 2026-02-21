<?php
require_once __DIR__ . '/../includes/db.php';

if (isset($_SESSION['admin_logged_in'])) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && ($password === $admin['password'] || password_verify($password, $admin['password']))) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        flash("Welcome back, Admin!", "success");
        redirect('index.php');
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ironman Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background-color: var(--darker-bg); }
        .login-card { max-width: 400px; margin-top: 100px; border-top: 5px solid var(--gold); }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card login-card p-4 w-100 shadow-lg">
        <div class="text-center mb-4">
            <h2 class="text-gold fw-bold"><i class="fas fa-user-shield me-2"></i> ADMIN LOGIN</h2>
            <p class="text-muted">Ironman Gym Automation System</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="admin">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="admin123">
            </div>
            <button type="submit" class="btn btn-gold w-100 py-3 mt-3">LOGIN TO DASHBOARD</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="../index.php" class="text-muted text-decoration-none small">Back to Website</a>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
