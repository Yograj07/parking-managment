<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
   header("Location: " . BASE_URL . "/login.php");
   exit;
}

$uid = (int) $_SESSION['user_id'];

$vehicles = mysqli_query(
   $conn,
   "SELECT id, vehicle_number, vehicle_type, created_at
    FROM vehicles
    WHERE user_id=$uid AND status='active'
    ORDER BY created_at DESC"
);
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Vehicles</title>
   <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/theme.css">
   <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
   <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>

   <?php include "../includes/unified_sidebar.php"; ?>

   <div class="main-content">
      <div class="page-header">
         <h1>My Vehicles</h1>
         <p class="muted">Add and manage vehicles for quick parking.</p>
      </div>

      <?php include "../includes/flash.php"; ?>

      <div class="card">
         <h3>Add Vehicle</h3>
         <form method="POST" action="<?= BASE_URL ?>/actions/user/add_vehicle.php">
            <div class="form-grid">
               <div class="form-group">
                  <label for="vehicle_number">Vehicle Number</label>
                  <input id="vehicle_number" name="vehicle_number" placeholder="GJ01AB1234" required>
               </div>
               <div class="form-group">
                  <label for="vehicle_type">Vehicle Type</label>
                  <select id="vehicle_type" name="vehicle_type" required>
                     <option value="">Select Type</option>
                     <option>Bike</option>
                     <option>Car</option>
                     <option>Truck</option>
                  </select>
               </div>
               <div class="form-group">
                  <button type="submit">Add Vehicle</button>
               </div>
            </div>
         </form>
      </div>

      <div class="card" style="margin-top:25px;">
         <h3>Your Vehicles</h3>

         <?php if (mysqli_num_rows($vehicles)): ?>
            <div class="table-wrapper">
               <table>
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Added</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;
                     while ($v = mysqli_fetch_assoc($vehicles)): ?>
                        <tr>
                           <td><?= $i++ ?></td>
                           <td><?= strtoupper(htmlspecialchars($v['vehicle_number'])) ?></td>
                           <td><?= htmlspecialchars($v['vehicle_type']) ?></td>
                           <td><?= date("d M Y", strtotime($v['created_at'])) ?></td>
                        </tr>
                     <?php endwhile; ?>
                  </tbody>
               </table>
            </div>
         <?php else: ?>
            <div class="empty-state">No vehicles yet.</div>
         <?php endif; ?>
      </div>
   </div>

   <script src="<?= BASE_URL ?>/assets/js/layout.js"></script>
</body>

</html>
