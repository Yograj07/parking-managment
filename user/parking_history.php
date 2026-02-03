<?php
require_once "../config/db.php";
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
  header("Location: " . BASE_URL . "/login.php");
  exit;
}

$uid = (int) $_SESSION['user_id'];

$history = mysqli_query(
  $conn,
  "SELECT v.vehicle_number, v.vehicle_type, ps.slot_number, pr.entry_time, pr.exit_time, pr.status
   FROM parking_records pr
   JOIN vehicles v ON pr.vehicle_id=v.id
   JOIN parking_slots ps ON pr.slot_id=ps.id
   WHERE v.user_id=$uid
   ORDER BY pr.entry_time DESC"
);

function formatDuration($entry, $exit)
{
  if (!$exit) {
    return "In progress";
  }
  $start = new DateTime($entry);
  $end = new DateTime($exit);
  $diff = $start->diff($end);

  $parts = [];
  if ($diff->days > 0) {
    $parts[] = $diff->days . "d";
  }
  if ($diff->h > 0) {
    $parts[] = $diff->h . "h";
  }
  if ($diff->i > 0 || empty($parts)) {
    $parts[] = $diff->i . "m";
  }
  return implode(" ", $parts);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parking History</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/theme.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
  <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>

  <?php include "../includes/unified_sidebar.php"; ?>

  <div class="main-content">
    <div class="page-header">
      <h1>Parking History</h1>
      <p class="muted">Track all your parking entries and exits.</p>
    </div>

    <?php include "../includes/flash.php"; ?>

    <div class="card">
      <?php if (mysqli_num_rows($history)): ?>
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Vehicle</th>
                <th>Type</th>
                <th>Slot</th>
                <th>Entry</th>
                <th>Exit</th>
                <th>Duration</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($h = mysqli_fetch_assoc($history)): ?>
                <tr>
                  <td><?= strtoupper(htmlspecialchars($h['vehicle_number'])) ?></td>
                  <td><?= htmlspecialchars($h['vehicle_type']) ?></td>
                  <td><?= htmlspecialchars($h['slot_number']) ?></td>
                  <td><?= date("d M Y h:i A", strtotime($h['entry_time'])) ?></td>
                  <td><?= $h['exit_time'] ? date("d M Y h:i A", strtotime($h['exit_time'])) : '-' ?></td>
                  <td><?= htmlspecialchars(formatDuration($h['entry_time'], $h['exit_time'])) ?></td>
                  <td><span class="badge <?= htmlspecialchars($h['status']) ?>"><?= ucfirst($h['status']) ?></span></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="empty-state">No history found.</div>
      <?php endif; ?>
    </div>
  </div>

  <script src="<?= BASE_URL ?>/assets/js/layout.js"></script>
</body>

</html>
