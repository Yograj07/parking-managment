<?php
require_once __DIR__ . '/../../config/db.php';

session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$parkingId = (int) ($_GET['id'] ?? 0);
$userId = (int) $_SESSION['user_id'];

if ($parkingId <= 0) {
    header("Location: " . BASE_URL . "/user/parking.php");
    exit;
}

/* GET SLOT ID (user-owned record) */
$stmt = mysqli_prepare(
    $conn,
    "SELECT pr.slot_id
     FROM parking_records pr
     JOIN vehicles v ON pr.vehicle_id = v.id
     WHERE pr.id = ? AND pr.status='parked' AND v.user_id = ?
     LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "ii", $parkingId, $userId);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) === 0) {
    $_SESSION['error'] = "Invalid parking record";
    header("Location: " . BASE_URL . "/user/parking.php");
    exit;
}

$row = mysqli_fetch_assoc($res);
$slotId = (int) $row['slot_id'];

/* EXIT VEHICLE */
$upd = mysqli_prepare(
    $conn,
    "UPDATE parking_records
     SET exit_time=NOW(), status='exited'
     WHERE id=?"
);
mysqli_stmt_bind_param($upd, "i", $parkingId);
mysqli_stmt_execute($upd);

$slotUpd = mysqli_prepare(
    $conn,
    "UPDATE parking_slots SET status='available' WHERE id=?"
);
mysqli_stmt_bind_param($slotUpd, "i", $slotId);
mysqli_stmt_execute($slotUpd);

$_SESSION['success'] = "Vehicle exited successfully";
header("Location: " . BASE_URL . "/user/parking.php");
exit;
