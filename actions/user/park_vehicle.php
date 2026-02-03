<?php
require_once __DIR__ . '/../../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$userId    = (int) $_SESSION['user_id'];
$vehicleId = (int) ($_POST['vehicle_id'] ?? 0);
$slotId    = (int) ($_POST['slot_id'] ?? 0);

if ($vehicleId <= 0) {
    $_SESSION['error'] = "Please select a vehicle";
    header("Location: " . BASE_URL . "/user/parking.php");
    exit;
}

/* CHECK VEHICLE OWNERSHIP */
$vehStmt = mysqli_prepare(
    $conn,
    "SELECT id FROM vehicles WHERE id = ? AND user_id = ? AND status='active' LIMIT 1"
);
mysqli_stmt_bind_param($vehStmt, "ii", $vehicleId, $userId);
mysqli_stmt_execute($vehStmt);
$vehRes = mysqli_stmt_get_result($vehStmt);

if (mysqli_num_rows($vehRes) === 0) {
    $_SESSION['error'] = "Invalid vehicle selection";
    header("Location: " . BASE_URL . "/user/parking.php");
    exit;
}

/* CHECK: already parked? */
$chk = mysqli_prepare(
    $conn,
    "SELECT id FROM parking_records WHERE vehicle_id = ? AND status = 'parked' LIMIT 1"
);
mysqli_stmt_bind_param($chk, "i", $vehicleId);
mysqli_stmt_execute($chk);
$chkRes = mysqli_stmt_get_result($chk);

if (mysqli_num_rows($chkRes) > 0) {
    $_SESSION['error'] = "Vehicle already parked";
    header("Location: " . BASE_URL . "/user/parking.php");
    exit;
}

/* SLOT: preferred or auto-assign */
if ($slotId > 0) {
    $slotStmt = mysqli_prepare(
        $conn,
        "SELECT id FROM parking_slots WHERE id = ? AND status='available' LIMIT 1"
    );
    mysqli_stmt_bind_param($slotStmt, "i", $slotId);
    mysqli_stmt_execute($slotStmt);
    $slotRes = mysqli_stmt_get_result($slotStmt);

    if (mysqli_num_rows($slotRes) === 0) {
        $_SESSION['error'] = "Selected slot is not available";
        header("Location: " . BASE_URL . "/user/parking.php");
        exit;
    }
} else {
    $slotRow = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT id FROM parking_slots WHERE status='available' ORDER BY slot_number LIMIT 1")
    );

    if (!$slotRow) {
        $_SESSION['error'] = "No slots available";
        header("Location: " . BASE_URL . "/user/parking.php");
        exit;
    }

    $slotId = (int) $slotRow['id'];
}

/* PARK */
$ins = mysqli_prepare(
    $conn,
    "INSERT INTO parking_records (vehicle_id, slot_id, entry_time, status)
     VALUES (?, ?, NOW(), 'parked')"
);
mysqli_stmt_bind_param($ins, "ii", $vehicleId, $slotId);
mysqli_stmt_execute($ins);

$up = mysqli_prepare(
    $conn,
    "UPDATE parking_slots SET status='occupied' WHERE id=?"
);
mysqli_stmt_bind_param($up, "i", $slotId);
mysqli_stmt_execute($up);

$_SESSION['success'] = "Vehicle parked successfully";
header("Location: " . BASE_URL . "/user/parking.php");
exit;
