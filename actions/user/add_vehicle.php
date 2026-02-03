<?php
require_once __DIR__ . '/../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$userId = (int) $_SESSION['user_id'];

$vehicleNumber = strtoupper(trim($_POST['vehicle_number'] ?? ''));
$vehicleType   = trim($_POST['vehicle_type'] ?? '');

if ($vehicleNumber === '' || $vehicleType === '') {
    $_SESSION['error'] = "Please provide vehicle number and type";
    header("Location: " . BASE_URL . "/user/vehicles.php");
    exit;
}

/* CHECK: already exists? */
$check = mysqli_prepare(
    $conn,
    "SELECT id FROM vehicles WHERE vehicle_number = ?"
);
mysqli_stmt_bind_param($check, "s", $vehicleNumber);
mysqli_stmt_execute($check);
$res = mysqli_stmt_get_result($check);

if (mysqli_num_rows($res) > 0) {
    $_SESSION['error'] = "Vehicle already registered";
    header("Location: " . BASE_URL . "/user/vehicles.php");
    exit;
}

/* INSERT */
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO vehicles (vehicle_number, vehicle_type, user_id, status, created_at)
     VALUES (?, ?, ?, 'active', NOW())"
);
mysqli_stmt_bind_param($stmt, "ssi", $vehicleNumber, $vehicleType, $userId);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = "Vehicle added successfully";
header("Location: " . BASE_URL . "/user/vehicles.php");
exit;
