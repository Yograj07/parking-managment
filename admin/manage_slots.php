<?php
require_once "../includes/auth.php";
require_once "../config/db.php";

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Slots | Admin</title>

    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <?php include "../includes/unified_sidebar.php"; ?>

    <div class="main-content">

        <div class="page-header">
            <h1>Parking Slots</h1>
        </div>

        <!-- FLASH -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="card" style="color:green;margin-bottom:16px;">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="card" style="color:red;margin-bottom:16px;">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- ADD SLOT -->
        <div class="card" style="max-width:420px;">
            <h3>Add New Slot</h3>

            <form method="POST" action="../actions/admin/add_slot.php">
                <div class="form-group">
                    <input type="text" name="slot_number" placeholder="Slot Number (A1)" required>
                </div>
                <button type="submit">Add Slot</button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="card" style="margin-top:30px;">
            <h3>All Parking Slots</h3>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Slot Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $slots = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY slot_number");
                        $i = 1;

                        if (mysqli_num_rows($slots) === 0):
                        ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">No slots found</td>
                            </tr>
                            <?php else:
                            while ($s = mysqli_fetch_assoc($slots)):
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($s['slot_number']) ?></td>

                                    <!-- STATUS -->
                                    <td class="status-col">
                                        <span class="badge <?= $s['status'] ?>">
                                            <?= ucfirst($s['status']) ?>
                                        </span>
                                    </td>

                                    <!-- ACTION -->
                                    <td class="action-col">
                                        <?php if ($s['status'] === 'available'): ?>
                                            <a href="../actions/admin/disable_slot.php?id=<?= $s['id'] ?>"
                                                class="action-btn danger"
                                                onclick="return confirm('Disable this slot?')">
                                                Disable
                                            </a>

                                        <?php elseif ($s['status'] === 'disabled'): ?>
                                            <a href="../actions/admin/enable_slot.php?id=<?= $s['id'] ?>"
                                                class="action-btn success">
                                                Enable
                                            </a>

                                        <?php else: ?>
                                            <span class="action-placeholder">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php endwhile;
                        endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="../assets/js/layout.js"></script>
</body>

</html>
