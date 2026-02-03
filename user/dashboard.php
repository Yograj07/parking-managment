<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
  header("Location: " . BASE_URL . "/login.php");
  exit;
}

$uid = (int) $_SESSION['user_id'];

$totalVehicles = mysqli_fetch_assoc(mysqli_query(
  $conn,
  "SELECT COUNT(*) c FROM vehicles WHERE user_id=$uid AND status='active'"
))['c'];

$activeParking = mysqli_fetch_assoc(mysqli_query(
  $conn,
  "SELECT COUNT(*) c FROM parking_records pr
   JOIN vehicles v ON pr.vehicle_id=v.id
   WHERE v.user_id=$uid AND pr.status='parked'"
))['c'];

$totalVisits = mysqli_fetch_assoc(mysqli_query(
  $conn,
  "SELECT COUNT(*) c FROM parking_records pr
   JOIN vehicles v ON pr.vehicle_id=v.id
   WHERE v.user_id=$uid"
))['c'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/theme.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
  <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>

  <?php include "../includes/unified_sidebar.php"; ?>

  <div class="main-content">
    <div class="page-header">
      <h1>Dashboard</h1>
      <p class="muted">Welcome back, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
    </div>

    <?php include "../includes/flash.php"; ?>

    <div class="dashboard-grid">
      <div class="stat-card">
        <h4>Total Vehicles</h4><span><?= $totalVehicles ?></span>
      </div>
      <div class="stat-card success">
        <h4>Active Parking</h4><span><?= $activeParking ?></span>
      </div>
      <div class="stat-card">
        <h4>Total Visits</h4><span><?= $totalVisits ?></span>
      </div>
    </div>

    <div class="card" style="margin-top:25px;">
      <h3>Quick Actions</h3>
      <div class="quick-actions">
        <a href="<?= BASE_URL ?>/user/vehicles.php" class="qa-btn">Add Vehicle</a>
        <a href="<?= BASE_URL ?>/user/parking.php" class="qa-btn">Park Vehicle</a>
        <a href="<?= BASE_URL ?>/user/parking_history.php" class="qa-btn">View History</a>
      </div>
    </div>
  </div>

  <script src="<?= BASE_URL ?>/assets/js/layout.js"></script>
</body>

</html>
