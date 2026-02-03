<?php
require_once "../includes/auth.php";
require_once "../config/db.php";

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied");
}

/* ================= DASHBOARD STATS ================= */
$totalSlots     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM parking_slots"))['c'];
$availableSlots = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM parking_slots WHERE status='available'"))['c'];
$occupiedSlots  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM parking_slots WHERE status='occupied'"))['c'];
$disabledSlots  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM parking_slots WHERE status='disabled'"))['c'];

$totalVehicles  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM vehicles"))['c'];
$totalUsers     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users WHERE role='user'"))['c'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | ParkFlow</title>

    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <?php include "../includes/unified_sidebar.php"; ?>

    <div class="main-content">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1>Admin Dashboard</h1>
            <p style="color:var(--text-muted); margin-top:6px;">
                Welcome back, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
            </p>
        </div>

        <!-- STATS GRID -->
        <div class="dashboard-grid">

            <div class="stat-card">
                <h4>Total Slots</h4>
                <span><?= $totalSlots ?></span>
            </div>

            <div class="stat-card success">
                <h4>Available Slots</h4>
                <span><?= $availableSlots ?></span>
            </div>

            <div class="stat-card danger">
                <h4>Occupied Slots</h4>
                <span><?= $occupiedSlots ?></span>
            </div>

            <div class="stat-card muted">
                <h4>Disabled Slots</h4>
                <span><?= $disabledSlots ?></span>
            </div>

            <div class="stat-card">
                <h4>Total Vehicles</h4>
                <span><?= $totalVehicles ?></span>
            </div>

            <div class="stat-card">
                <h4>Total Users</h4>
                <span><?= $totalUsers ?></span>
            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <div class="card" style="margin-top:30px;">
            <h3>Quick Actions</h3>

            <div class="quick-actions">
                <a href="manage_slots.php" class="qa-btn">Manage Slots</a>
                
                <a href="manage_users.php" class="qa-btn">Manage Users</a>
                <a href="reports.php" class="qa-btn">View Reports</a>
            </div>
        </div>


    </div>

    <script src="../assets/js/layout.js"></script>
</body>

</html>
