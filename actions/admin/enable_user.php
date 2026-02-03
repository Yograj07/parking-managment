<?php
require_once __DIR__ . '/../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$userId = (int) ($_GET['id'] ?? 0);

if ($userId <= 0) {
    header("Location: " . BASE_URL . "/admin/manage_users.php");
    exit;
}

mysqli_query($conn, "UPDATE users SET status='active' WHERE id=$userId AND role='user'");
$_SESSION['success'] = "User enabled";
header("Location: " . BASE_URL . "/admin/manage_users.php");
exit;
