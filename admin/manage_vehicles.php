<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
if ($_SESSION["role"] !== "admin") {
    die("Access denied");
}
?>

<h2>Manage Vehicles</h2>

<form method="POST">
    <input type="text" name="vehicle_number" placeholder="Vehicle Number (GJ01AB1234)" required>

    <select name="vehicle_type" required>
        <option value="">Select Type</option>
        <option value="Car">Car</option>
        <option value="Bike">Bike</option>
        <option value="Truck">Truck</option>
    </select>

    <select name="user_id" required>
        <option value="">Select Owner</option>
        <?php
        $users = mysqli_query($conn, "SELECT id, name FROM users WHERE role='user' AND status='active'");
        while ($u = mysqli_fetch_assoc($users)) {
            echo "<option value='{$u['id']}'>{$u['name']}</option>";
        }
        ?>
    </select>

    <button type="submit" name="add_vehicle">Add Vehicle</button>
</form>

<!-- Adding vehicles to the owner :  -->

<?php
if (isset($_POST['add_vehicle'])) {

    $vehicle_number = strtoupper(trim($_POST['vehicle_number']));
    $vehicle_type   = $_POST['vehicle_type'];
    $user_id        = $_POST['user_id'];

    if ($vehicle_number && $vehicle_type && $user_id) {

        $sql = "INSERT INTO vehicles (vehicle_number, vehicle_type, user_id, status)
                VALUES (?, ?, ?, 'active')";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $vehicle_number,
            $vehicle_type,
            $user_id
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "<p style='color:green;'>Vehicle added successfully</p>";
        } else {
            echo "<p style='color:red;'>Vehicle already exists</p>";
        }
    }
}
?>

<!-- view all vehicles -->

<h3>All Vehicles</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Vehicle Number</th>
        <th>Type</th>
        <th>Owner</th>
        <th>Status</th>
    </tr>

    <?php
    $sql = "
SELECT v.id, v.vehicle_number, v.vehicle_type, v.status, u.name
FROM vehicles v
JOIN users u ON v.user_id = u.id
ORDER BY v.id DESC
";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['vehicle_number']}</td>";
        echo "<td>{$row['vehicle_type']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
    }
    ?>
</table>