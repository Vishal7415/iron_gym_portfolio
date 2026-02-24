<?php
require_once __DIR__ . '/../includes/db.php';

if (admin_is_logged_in()) {
    redirect('index.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && ($password === $admin['password'] || password_verify($password, $admin['password']))) {
        admin_login_set($admin['username']);
        flash("Welcome back, " . $admin['username'] . "!", "success");
        redirect('index.php');
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — <?php echo GYM_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #D4AF37;
            --gold-dark: #B8860B;
            --gold-glow: rgba(212,175,55,0.12);
            --bg: #0D0D0F;
            --card-bg: #16181F;
            --card-border: rgba(255,255,255,0.07);
            --text-light: #F0EEE9;
            --text-muted: #7A7A8A;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(212,175,55,0.04) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 80%, rgba(139,105,20,0.03) 0%, transparent 60%);
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 24px;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-brand .brand-icon {
            width: 60px; height: 60px;
            background: var(--gold-glow);
            border: 1px solid rgba(212,175,55,0.25);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            color: var(--gold); font-size: 1.5rem;
        }
        .login-brand h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 4px;
        }
        .login-brand small { color: var(--text-muted); font-size: 0.82rem; }

        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.4);
        }

        .login-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 6px;
        }
        .login-card p { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 28px; }

        .form-label {
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }
        .form-control {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--card-border);
            color: var(--text-light);
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif;
            transition: all 0.2s;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.06);
            border-color: var(--gold);
            color: var(--text-light);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
            outline: none;
        }
        .form-control::placeholder { color: var(--text-muted); }

        .input-icon-wrap { position: relative; }
        .input-icon-wrap .icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 0.85rem; pointer-events: none;
        }
        .input-icon-wrap .form-control { padding-left: 40px; }

        .btn-login {
            width: 100%;
            background: var(--gold);
            color: #0D0D0F;
            font-weight: 800;
            font-size: 0.9rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border: none;
            border-radius: 12px;
            padding: 14px;
            cursor: pointer;
            transition: all 0.25s;
            margin-top: 8px;
        }
        .btn-login:hover {
            background: var(--gold-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(184,134,11,0.3);
        }

        .error-box {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px;
            padding: 12px 16px;
            color: #EF4444;
            font-size: 0.88rem;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }

        .back-link {
            text-align: center;
            margin-top: 24px;
        }
        .back-link a {
            color: var(--text-muted);
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .back-link a:hover { color: var(--text-light); }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-brand">
        <div class="brand-icon"><i class="fas fa-dumbbell"></i></div>
        <h2><?php echo GYM_NAME; ?></h2>
        <small>Secure Administration Portal</small>
    </div>

    <div class="login-card">
        <h3>Welcome Back</h3>
        <p>Sign in to access the admin dashboard</p>

        <?php if ($error): ?>
        <div class="error-box">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="mb-4">
                <label class="form-label">Username</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required autocomplete="username">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required autocomplete="current-password">
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Login to Dashboard
            </button>
        </form>
    </div>

    <div class="back-link">
        <a href="../index.php"><i class="fas fa-arrow-left"></i> Back to Website</a>
    </div>
</div>
</body>
</html>
