<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up | ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <div class="register-wrapper">
        <div class="register-card">

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

                <h1>Create Account</h1>
                <p>Join ParkFlow to start parking smarter</p>
            </div>

            <form action="actions/auth/register_action.php" method="POST">

                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required maxlength="50">
                </div>

                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="johndoe123" required maxlength="20">
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <small class="password-hint">
                        Must be 8+ chars with uppercase, lowercase, number & special character
                    </small>
                </div>

                <button type="submit" class="register-btn">Sign Up</button>
            </form>

            <div class="footer-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </div>
    </div>

    <script src="./assets/js/flash.js"></script>
    <script src="./assets/js/GoBack.js"></script>
</body>

</html>