<?php
// *? Logic for slotes include db and assuring admin auth.

require_once "../includes/auth.php";
require_once "../config/db.php";

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied");
}
?>

<h2>Manage Parking Slots</h2>

<form method="POST">
    <input type="text" name="slot_number" placeholder="Slot Number (A1)" required>
    <button type="submit" name="add_slot">Add Slot</button>
</form>

<?php
if (isset($_POST['add_slot'])) {
    $slot_number = strtoupper(trim($_POST['slot_number']));

    if ($slot_number !== "") {
        $sql = "INSERT INTO parking_slots (slot_number, status) VALUES (?, 'available')";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $slot_number);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p style='color:green;'>Slot added successfully</p>";
        } else {
            echo "<p style='color:red;'>Slot already exists</p>";
        }
    }
}
?>

<h3>All Parking Slots</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Slot Number</th>
        <th>Status</th>
    </tr>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY slot_number");

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['slot_number']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
    }
    ?>
</table>