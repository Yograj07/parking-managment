<?php
session_start();
require_once "../config/db.php";



if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
    }
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if ($username === "" || $password === "") {
        die("All fields are required");
        }

        // Fetch active user
        $sql = "SELECT id, username, password, role FROM users WHERE username = ? AND status = 'active' LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("Invalid credentials");
}

// TEMP: plain password check (we’ll hash next)
if (!password_verify($password, $user['password'])) {
    die("Invalid credentials");
}


// Set session
$_SESSION['user_id']  = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

// Redirect by role
if ($user['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
} else {
    header("Location: ../user/dashboard.php");
}
exit;
