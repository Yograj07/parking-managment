<?php
require_once __DIR__ . '/../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$slotId = (int) ($_GET['id'] ?? 0);

if ($slotId <= 0) {
    header("Location: " . BASE_URL . "/admin/manage_slots.php");
    exit;
}

$slotRes = mysqli_query($conn, "SELECT status FROM parking_slots WHERE id=$slotId LIMIT 1");
if (mysqli_num_rows($slotRes) === 0) {
    $_SESSION['error'] = "Slot not found";
    header("Location: " . BASE_URL . "/admin/manage_slots.php");
    exit;
}

$slot = mysqli_fetch_assoc($slotRes);
if ($slot['status'] === 'occupied') {
    $_SESSION['error'] = "Cannot disable an occupied slot";
    header("Location: " . BASE_URL . "/admin/manage_slots.php");
    exit;
}

mysqli_query($conn, "UPDATE parking_slots SET status='disabled' WHERE id=$slotId");
$_SESSION['success'] = "Slot disabled";
header("Location: " . BASE_URL . "/admin/manage_slots.php");
exit;
