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

mysqli_query($conn, "UPDATE parking_slots SET status='available' WHERE id=$slotId");
$_SESSION['success'] = "Slot enabled";
header("Location: " . BASE_URL . "/admin/manage_slots.php");
exit;
