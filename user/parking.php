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
    "SELECT id, vehicle_number, vehicle_type FROM vehicles
     WHERE user_id=$uid AND status='active'
     AND id NOT IN (
        SELECT vehicle_id FROM parking_records WHERE status='parked'
     )
     ORDER BY vehicle_number"
);

$slotsRes = mysqli_query($conn, "SELECT id, slot_number, status FROM parking_slots ORDER BY slot_number");
$slots = [];
$availableSlots = [];
while ($s = mysqli_fetch_assoc($slotsRes)) {
    $slots[] = $s;
    if ($s['status'] === 'available') {
        $availableSlots[] = $s;
    }
}
$availableCount = count($availableSlots);
$vehicleCount = mysqli_num_rows($vehicles);

$parked = mysqli_query(
    $conn,
    "SELECT pr.id, v.vehicle_number, v.vehicle_type, ps.slot_number, pr.entry_time
     FROM parking_records pr
     JOIN vehicles v ON pr.vehicle_id=v.id
     JOIN parking_slots ps ON pr.slot_id=ps.id
     WHERE v.user_id=$uid AND pr.status='parked'
     ORDER BY pr.entry_time DESC"
);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/theme.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <?php include "../includes/unified_sidebar.php"; ?>

    <div class="main-content">
        <div class="page-header">
            <h1>Parking</h1>
            <p class="muted">Park a vehicle, manage exits, and view slot availability.</p>
        </div>

        <?php include "../includes/flash.php"; ?>

        <div class="grid-2">
            <div class="card">
                <h3>Park Vehicle</h3>

                <?php if ($vehicleCount === 0): ?>
                    <div class="empty-state">No eligible vehicles to park.</div>
                <?php else: ?>
                    <form method="POST" action="<?= BASE_URL ?>/actions/user/park_vehicle.php">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="vehicle_id">Vehicle</label>
                                <select id="vehicle_id" name="vehicle_id" required>
                                    <option value="">Select Vehicle</option>
                                    <?php while ($v = mysqli_fetch_assoc($vehicles)): ?>
                                        <option value="<?= $v['id'] ?>">
                                            <?= strtoupper(htmlspecialchars($v['vehicle_number'])) ?>
                                            (<?= htmlspecialchars($v['vehicle_type']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slot_id">Preferred Slot (optional)</label>
                                <select id="slot_id" name="slot_id" <?= $availableCount === 0 ? 'disabled' : '' ?>>
                                    <option value="">Auto-assign</option>
                                    <?php foreach ($availableSlots as $s): ?>
                                        <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['slot_number']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="hint">Auto-assign will pick the next available slot.</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" <?= $availableCount === 0 ? 'disabled' : '' ?>>Park</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <div class="card">
                <h3>Available Slots</h3>
                <p class="muted">Available: <strong><?= $availableCount ?></strong></p>

                <?php if (count($slots) === 0): ?>
                    <div class="empty-state">No slots configured yet.</div>
                <?php else: ?>
                    <div class="slot-grid">
                        <?php foreach ($slots as $s): ?>
                            <span class="slot-chip <?= htmlspecialchars($s['status']) ?>">
                                <?= htmlspecialchars($s['slot_number']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card" style="margin-top:25px;">
            <h3>Currently Parked</h3>
            <?php if (mysqli_num_rows($parked)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Slot</th>
                                <th>Entry</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = mysqli_fetch_assoc($parked)): ?>
                                <tr>
                                    <td><?= strtoupper(htmlspecialchars($p['vehicle_number'])) ?></td>
                                    <td><?= htmlspecialchars($p['slot_number']) ?></td>
                                    <td><?= date("d M Y h:i A", strtotime($p['entry_time'])) ?></td>
                                    <td>
                                        <a class="action-btn danger"
                                           href="<?= BASE_URL ?>/actions/user/exit_vehicle.php?id=<?= $p['id'] ?>">
                                            Exit
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">No active parking.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/layout.js"></script>
</body>

</html>
