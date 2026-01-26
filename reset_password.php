<?php
session_start();

$token = $_GET['token'] ?? '';

if ($token === '') {
    $_SESSION['error'] = "Invalid or expired reset link";
    header("Location: forgot_password.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password | ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body data-redirect="login.php">

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
                <h2>Reset Password</h2>
                <p>Create a new password</p>
            </div>

            <form action="actions/reset_password_action.php" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="input-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="New password" required>
                </div>

                <button type="submit" class="login-btn">Reset Password</button>
            </form>

        </div>
    </div>

    <script src="assets/js/flash.js"></script>
</body>

</html>