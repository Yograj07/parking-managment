<?php
require_once "../includes/auth.php";
require_once "../config/db.php";

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$parkedCount = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) c FROM parking_records WHERE status='parked'"
))['c'];

$todayCount = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) c FROM parking_records WHERE DATE(entry_time) = CURDATE()"
))['c'];

$totalCount = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) c FROM parking_records"
))['c'];

$parked = mysqli_query(
    $conn,
    "SELECT v.vehicle_number, s.slot_number, p.entry_time
     FROM parking_records p
     JOIN vehicles v ON p.vehicle_id = v.id
     JOIN parking_slots s ON p.slot_id = s.id
     WHERE p.status = 'parked'
     ORDER BY p.entry_time DESC"
);

$today = mysqli_query(
    $conn,
    "SELECT v.vehicle_number, s.slot_number, p.entry_time, p.exit_time, p.status
     FROM parking_records p
     JOIN vehicles v ON p.vehicle_id = v.id
     JOIN parking_slots s ON p.slot_id = s.id
     WHERE DATE(p.entry_time) = CURDATE()
     ORDER BY p.entry_time DESC"
);

$history = mysqli_query(
    $conn,
    "SELECT v.vehicle_number, s.slot_number, p.entry_time, p.exit_time, p.status
     FROM parking_records p
     JOIN vehicles v ON p.vehicle_id = v.id
     JOIN parking_slots s ON p.slot_id = s.id
     ORDER BY p.entry_time DESC"
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Admin</title>

    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <?php include "../includes/unified_sidebar.php"; ?>

    <div class="main-content">
        <div class="page-header">
            <h1>Reports</h1>
            <p class="muted">Parking activity overview and history.</p>
        </div>

        <div class="dashboard-grid">
            <div class="stat-card">
                <h4>Currently Parked</h4>
                <span><?= $parkedCount ?></span>
            </div>
            <div class="stat-card success">
                <h4>Today's Activity</h4>
                <span><?= $todayCount ?></span>
            </div>
            <div class="stat-card">
                <h4>Total Records</h4>
                <span><?= $totalCount ?></span>
            </div>
        </div>

        <div class="card" style="margin-top:25px;">
            <h3>Currently Parked Vehicles</h3>
            <?php if (mysqli_num_rows($parked)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Slot</th>
                                <th>Entry Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($parked)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['vehicle_number']) ?></td>
                                    <td><?= htmlspecialchars($row['slot_number']) ?></td>
                                    <td><?= date("d M Y h:i A", strtotime($row['entry_time'])) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">No active parking.</div>
            <?php endif; ?>
        </div>

        <div class="card" style="margin-top:25px;">
            <h3>Today's Parking Activity</h3>
            <?php if (mysqli_num_rows($today)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Slot</th>
                                <th>Entry</th>
                                <th>Exit</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($today)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['vehicle_number']) ?></td>
                                    <td><?= htmlspecialchars($row['slot_number']) ?></td>
                                    <td><?= date("d M Y h:i A", strtotime($row['entry_time'])) ?></td>
                                    <td><?= $row['exit_time'] ? date("d M Y h:i A", strtotime($row['exit_time'])) : '-' ?></td>
                                    <td><?= htmlspecialchars(formatDuration($row['entry_time'], $row['exit_time'])) ?></td>
                                    <td><span class="badge <?= htmlspecialchars($row['status']) ?>"><?= ucfirst($row['status']) ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">No activity today.</div>
            <?php endif; ?>
        </div>

        <div class="card" style="margin-top:25px;">
            <h3>Full Parking History</h3>
            <?php if (mysqli_num_rows($history)): ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Slot</th>
                                <th>Entry</th>
                                <th>Exit</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($history)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['vehicle_number']) ?></td>
                                    <td><?= htmlspecialchars($row['slot_number']) ?></td>
                                    <td><?= date("d M Y h:i A", strtotime($row['entry_time'])) ?></td>
                                    <td><?= $row['exit_time'] ? date("d M Y h:i A", strtotime($row['exit_time'])) : '-' ?></td>
                                    <td><?= htmlspecialchars(formatDuration($row['entry_time'], $row['exit_time'])) ?></td>
                                    <td><span class="badge <?= htmlspecialchars($row['status']) ?>"><?= ucfirst($row['status']) ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">No records found.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="../assets/js/layout.js"></script>
</body>

</html>
