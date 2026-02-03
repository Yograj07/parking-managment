<?php
require_once __DIR__ . '/../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$slotNumber = strtoupper(trim($_POST['slot_number'] ?? ''));

if ($slotNumber === '') {
    $_SESSION['error'] = "Please provide a slot number";
    header("Location: " . BASE_URL . "/admin/manage_slots.php");
    exit;
}

$check = mysqli_prepare($conn, "SELECT id FROM parking_slots WHERE slot_number = ? LIMIT 1");
mysqli_stmt_bind_param($check, "s", $slotNumber);
mysqli_stmt_execute($check);
$res = mysqli_stmt_get_result($check);

if (mysqli_num_rows($res) > 0) {
    $_SESSION['error'] = "Slot already exists";
    header("Location: " . BASE_URL . "/admin/manage_slots.php");
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO parking_slots (slot_number, status) VALUES (?, 'available')");
mysqli_stmt_bind_param($stmt, "s", $slotNumber);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = "Slot added successfully";
header("Location: " . BASE_URL . "/admin/manage_slots.php");
exit;
