<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password | ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
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
                <h2>Forgot Password</h2>
                <p>Enter your registered email to reset password</p>
            </div>

            <form action="actions/auth/forgot_password.php" method="POST">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="login-btn">Send Reset Link</button>
            </form>

            <div class="card-footer">
                <p><a href="login.php">Back to Login</a></p>
            </div>

        </div>
    </div>

    <script src="assets/js/flash.js"></script>
</body>

</html>
