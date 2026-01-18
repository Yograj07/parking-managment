<?php
    require_once "../includes/auth.php";
    require_once "../config/db.php";

    if ($_SESSION['role'] !== 'admin') {
        die("Access denied");
    }
    ?>
<!-- Currently parked vehicles  -->

<h2>Currently Parked Vehicles</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Vehicle</th>
        <th>Slot</th>
        <th>Entry Time</th>
    </tr>

    <?php
    $sql = "SELECT v.vehicle_number, s.slot_number, p.entry_time
FROM parking_records p
JOIN vehicles v ON p.vehicle_id = v.id
JOIN parking_slots s ON p.slot_id = s.id
WHERE p.status = 'parked'
ORDER BY p.entry_time";

    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>{$row['vehicle_number']}</td>";
        echo "<td>{$row['slot_number']}</td>";
        echo "<td>{$row['entry_time']}</td>";
        echo "</tr>";
    }
    ?>
</table>

<h2>Today’s Parking Activity</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Vehicle</th>
        <th>Slot</th>
        <th>Entry</th>
        <th>Exit</th>
        <th>Status</th>
    </tr>

    <?php
    $sql = "SELECT v.vehicle_number, s.slot_number, p.entry_time, p.exit_time, p.status
    FROM parking_records p
    JOIN vehicles v ON p.vehicle_id = v.id
    JOIN parking_slots s ON p.slot_id = s.id
    WHERE DATE(p.entry_time) = CURDATE()
    ORDER BY p.entry_time ";

    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>{$row['vehicle_number']}</td>";
        echo "<td>{$row['slot_number']}</td>";
        echo "<td>{$row['entry_time']}</td>";
        echo "<td>" . ($row['exit_time'] ?? '-') . "</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
    }
    ?>
</table>


<h2>Full Parking History</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Vehicle</th>
    <th>Slot</th>
    <th>Entry</th>
    <th>Exit</th>
</tr>

<?php
$sql = "SELECT v.vehicle_number, s.slot_number, p.entry_time, p.exit_time
FROM parking_records p
JOIN vehicles v ON p.vehicle_id = v.id
JOIN parking_slots s ON p.slot_id = s.id
ORDER BY p.entry_time ";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>{$row['vehicle_number']}</td>";
    echo "<td>{$row['slot_number']}</td>";
    echo "<td>{$row['entry_time']}</td>";
    echo "<td>" . ($row['exit_time'] ?? '-') . "</td>";
    echo "</tr>";
}
?>
</table>
