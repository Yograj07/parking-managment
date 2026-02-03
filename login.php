<?php
require_once __DIR__ . '/config/db.php';
session_start();

/* =====================
   Already Logged In
===================== */
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: " . BASE_URL . "/admin/dashboard.php");
    } else {
        header("Location: " . BASE_URL . "/user/dashboard.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ParkFlow</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">

            <!-- FLASH MESSAGES -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-alert" id="flashAlert">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-alert" id="flashAlert">
                    <?= $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <div class="card-header">
                <div class="navigate-back">
                    <a href="javascript:history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7" />
                        </svg>
                    </a>
                </div>

                <h2>Welcome Back</h2>
                <p>Please enter your credentials to continue</p>
            </div>

            <!-- 🔥 UPDATED ACTION PATH -->
            <form action="<?= BASE_URL ?>/actions/auth/login_action.php" method="POST">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="form-options">
                    <a href="<?= BASE_URL ?>/forgot_password.php" class="forgot-link">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="card-footer">
                <p>
                    Don't have an account?
                    <a href="<?= BASE_URL ?>/register.php">Register</a>
                </p>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/flash.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/GoBack.js"></script>
</body>

</html>