<?php
session_start();
require_once "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

function returnWithError($msg)
{
    $_SESSION['error'] = $msg;
    header("Location: ../../login.php");
    exit;
}

if ($username === "" || $password === "") {
    returnWithError("Please fill in all fields.");
}

$sql = "SELECT id, username, password, role FROM users WHERE username = ? AND status = 'active' LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user || !password_verify($password, $user['password'])) {
    returnWithError("Invalid username or password.");
}

$_SESSION['user_id']  = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

if ($user['role'] === 'admin') {
    header("Location: ../../admin/dashboard.php");
} else {
    header("Location: ../../user/dashboard.php");
}
exit;
