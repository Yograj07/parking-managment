<?php
session_start();
require_once "../../config/db.php";

/* =====================
   Allow POST only
===================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request";
    header("Location: ../../forgot_password.php");
    exit;
}

$token       = $_POST['token'] ?? '';
$newPassword = $_POST['password'] ?? '';

if ($token === '' || $newPassword === '') {
    $_SESSION['error'] = "Invalid reset request";
    header("Location: ../../forgot_password.php");
    exit;
}

/* =====================
   Validate token
===================== */
$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM users
     WHERE reset_token = ?
       AND reset_token_expiry > NOW()
     LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    $_SESSION['error'] = "Reset link expired or already used";
    header("Location: ../../forgot_password.php");
    exit;
}

$user = mysqli_fetch_assoc($result);

/* =====================
   Hash new password
===================== */
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

/* =====================
   Update password & clear token
===================== */
$update = mysqli_prepare(
    $conn,
    "UPDATE users
     SET password = ?, reset_token = NULL, reset_token_expiry = NULL
     WHERE id = ?"
);
mysqli_stmt_bind_param($update, "si", $hashed, $user['id']);
mysqli_stmt_execute($update);

/* =====================
   Success redirect
===================== */
$_SESSION['success'] = "Password reset successful. Please login.";
header("Location: ../../login.php");
exit;
