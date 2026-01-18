<?php
require_once "../config/db.php";
require_once "../includes/auth.php";

if ($_SESSION["role"] !== "admin") {
    die("Access denied!");
}
?>
<link rel="stylesheet" href="../assets/css/style.css">

<div class="container">

    <h2>Vehicle Entry</h2>

    <form method="POST">
        <!-- Vehicle dropdown -->
        <select name="vehicle_id" required>
            <option value="">Select Vehicle</option>
            <?php
            $vehicles = mysqli_query(
                $conn,
                "SELECT id, vehicle_number 
             FROM vehicles 
             WHERE status = 'active'
             AND id NOT IN (
                SELECT vehicle_id 
                FROM parking_records 
                WHERE status = 'parked'
             )"
            );

            while ($v = mysqli_fetch_assoc($vehicles)) {
                echo "<option value='{$v['id']}'>{$v['vehicle_number']}</option>";
            }
            ?>
        </select>

        <!-- Slot dropdown -->
        <select name="slot_id" required>
            <option value="">Select Available Slot</option>
            <?php
            $slots = mysqli_query(
                $conn,
                "SELECT id, slot_number 
             FROM parking_slots 
             WHERE status = 'available'"
            );

            while ($s = mysqli_fetch_assoc($slots)) {
                echo "<option value='{$s['id']}'>{$s['slot_number']}</option>";
            }
            ?>
        </select>

        <button type="submit" name="park_vehicle">Park Vehicle</button>
    </form>

    <?php
    if (isset($_POST['park_vehicle'])) {
        $vehicle_id = isset($_POST['vehicle_id']) ? (int)$_POST['vehicle_id'] : 0;
        $slot_id    = isset($_POST['slot_id']) ? (int)$_POST['slot_id'] : 0;

        if ($vehicle_id === 0 || $slot_id === 0) {
            echo "<p style='color:red;'>Please select both vehicle and slot</p>";
            return;
        }


        /*  Vehicle can be parked only once */
        $check_vehicle = mysqli_query(
            $conn,
            "SELECT id FROM parking_records 
         WHERE vehicle_id = $vehicle_id 
         AND status = 'parked'"
        );

        if (mysqli_num_rows($check_vehicle) > 0) {
            echo "<p style='color:red;'>This vehicle is already parked</p>";
        } else {

            /* RULE 2: Slot must still be available */
            $check_slot = mysqli_query(
                $conn,
                "SELECT id FROM parking_slots 
             WHERE id = $slot_id 
             AND status = 'available'"
            );

            if (mysqli_num_rows($check_slot) == 0) {
                echo "<p style='color:red;'>Selected slot is no longer available</p>";
            } else {

                /* Insert parking record */
                $insert = "INSERT INTO parking_records 
                       (vehicle_id, slot_id, entry_time, status)
                       VALUES (?, ?, NOW(), 'parked')";

                $stmt = mysqli_prepare($conn, $insert);
                mysqli_stmt_bind_param($stmt, "ii", $vehicle_id, $slot_id);

                if (mysqli_stmt_execute($stmt)) {

                    /*  Mark slot as occupied */
                    mysqli_query(
                        $conn,
                        "UPDATE parking_slots 
                     SET status = 'occupied' 
                     WHERE id = $slot_id"
                    );

                    echo "<p style='color:green;'>Vehicle parked successfully</p>";
                }
            }
        }
    }
    ?>

    <h3>Currently Parked Vehicles</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>Vehicle</th>
            <th>Slot</th>
            <th>Entry Time</th>
        </tr>

        <?php
        $sql = "SELECT 
    v.vehicle_number, 
    s.slot_number, 
    p.entry_time
    FROM parking_records p
    INNER JOIN vehicles v ON p.vehicle_id = v.id
    INNER JOIN parking_slots s ON p.slot_id = s.id
    WHERE p.status = 'parked'
    ORDER BY p.entry_time DESC";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['vehicle_number']}</td>";
            echo "<td>{$row['slot_number']}</td>";
            echo "<td>{$row['entry_time']}</td>";
            echo "</tr>";
        }
        ?>
    </table>


    <!-- Exit vehicle logic -->

    <h2>Vehicle Exit</h2>

    <form method="POST">
        <select name="exit_record_id" required>
            <option value="">Select Parked Vehicle</option>

            <?php
            $exit_q = "
        SELECT 
            p.id AS record_id,
            v.vehicle_number,
            s.slot_number
        FROM parking_records p
        JOIN vehicles v ON p.vehicle_id = v.id
        JOIN parking_slots s ON p.slot_id = s.id
        WHERE p.status = 'parked'
        ";

            $exit_res = mysqli_query($conn, $exit_q);

            while ($row = mysqli_fetch_assoc($exit_res)) {
                echo "<option value='{$row['record_id']}'>
                    {$row['vehicle_number']} (Slot {$row['slot_number']})
                  </option>";
            }
            ?>
        </select>

        <button type="submit" name="exit_vehicle">Exit Vehicle</button>
    </form>


    <?php
    if (isset($_POST['exit_vehicle'])) {

        $record_id = isset($_POST['exit_record_id'])
            ? (int)$_POST['exit_record_id']
            : 0;

        if ($record_id === 0) {
            echo "<p style='color:red;'>Invalid selection</p>";
            return;
        }

        // 1️⃣ Get slot_id for this parking record
        $rec_q = mysqli_query(
            $conn,
            "SELECT slot_id 
         FROM parking_records 
         WHERE id = $record_id 
         AND status = 'parked'"
        );

        if (mysqli_num_rows($rec_q) === 0) {
            echo "<p style='color:red;'>Invalid or already exited record</p>";
            return;
        }

        $rec = mysqli_fetch_assoc($rec_q);
        $slot_id = $rec['slot_id'];

        // 2️⃣ Update parking record (EXIT)
        mysqli_query(
            $conn,
            "UPDATE parking_records 
         SET exit_time = NOW(), status = 'exited'
         WHERE id = $record_id"
        );

        // 3️⃣ Free the parking slot
        mysqli_query(
            $conn,
            "UPDATE parking_slots 
         SET status = 'available'
         WHERE id = $slot_id"
        );

        echo "<p style='color:green;'>Vehicle exited successfully</p>";
    }
    ?>
</div>
    