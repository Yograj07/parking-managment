<?php
session_start();
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request";
    header("Location: ../forgot_password.php");
    exit;
}

$email = trim($_POST['email'] ?? '');

if ($email === '') {
    $_SESSION['error'] = "Email is required";
    header("Location: ../forgot_password.php");
    exit;
}

// 1️⃣ Check if user exists
$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE email = ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    $_SESSION['error'] = "Email not registered";
    header("Location: ../forgot_password.php");
    exit;
}

$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

// 2️⃣ Generate secure token
$token  = bin2hex(random_bytes(32));
$expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

// 3️⃣ Save token
$update = mysqli_prepare(
    $conn,
    "UPDATE users 
     SET reset_token = ?, reset_token_expiry = ?
     WHERE id = ?"
);
mysqli_stmt_bind_param($update, "ssi", $token, $expiry, $user_id);
mysqli_stmt_execute($update);

/*
 DEV MODE:
 - Automatically open reset page
 REAL MODE (later):
 - Send email instead
*/
$_SESSION['success'] = "Reset link generated. Please reset your password.";
header("Location: ../reset_password.php?token=$token");
exit;
