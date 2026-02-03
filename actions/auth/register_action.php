<?php
session_start();
require_once "../../config/db.php";

/* =====================
   Allow POST only
===================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../register.php");
    exit;
}

$name     = trim($_POST['name'] ?? '');
$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

/* =====================
   Basic validation
===================== */
if ($name === '' || $username === '' || $email === '' || $password === '') {
    $_SESSION['error'] = "All fields are required";
    header("Location: ../../register.php");
    exit;
}

/* =====================
   Check duplicate username/email
===================== */
$check = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1"
);
mysqli_stmt_bind_param($check, "ss", $username, $email);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) > 0) {
    $_SESSION['error'] = "Username or email already exists";
    header("Location: ../../register.php");
    exit;
}

/* =====================
   Strong password validation
===================== */
if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[\W_]/', $password)
) {
    $_SESSION['error'] =
        "Password must be at least 8 characters and include uppercase, lowercase, number, and special character.";
    header("Location: ../../register.php");
    exit;
}

/* =====================
   Hash password
===================== */
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

/* =====================
   Insert user (role locked to USER)
===================== */
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users (name, username, email, password, role, status)
     VALUES (?, ?, ?, ?, 'user', 'active')"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $name,
    $username,
    $email,
    $hashedPassword
);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Account created successfully. Please login.";
    header("Location: ../../login.php");
    exit;
} else {
    $_SESSION['error'] = "Registration failed. Please try again.";
    header("Location: ../../register.php");
    exit;
}
