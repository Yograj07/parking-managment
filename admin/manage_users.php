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
    <title>Manage Users | Admin</title>

    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>

<body>

    <?php include "../includes/unified_sidebar.php"; ?>

    <div class="main-content">

        <div class="page-header">
            <h1>Manage Users</h1>
        </div>

        <!-- FLASH -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="card" style="color:green;margin-bottom:15px;">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="card" style="color:red;margin-bottom:15px;">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- USERS TABLE -->
        <div class="card">
            <h3>All Users</h3>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $q = "SELECT id, name, username, email, status FROM users WHERE role='user' ORDER BY id DESC";
                        $res = mysqli_query($conn, $q);
                        $i = 1;

                        if (mysqli_num_rows($res) === 0):
                        ?>
                            <tr>
                                <td colspan="6" style="text-align:center;">No users found</td>
                            </tr>
                            <?php else:
                            while ($u = mysqli_fetch_assoc($res)):
                                $statusClass = $u['status'] === 'active' ? 'available' : 'disabled';
                                $statusText  = $u['status'] === 'active' ? 'Active' : 'Disabled';
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($u['name']) ?></td>
                                    <td><?= htmlspecialchars($u['username']) ?></td>
                                    <td><?= htmlspecialchars($u['email']) ?></td>

                                    <td style="text-align:center;">
                                        <span class="badge <?= $statusClass ?>">
                                            <?= $statusText ?>
                                        </span>
                                    </td>

                                    <td style="text-align:center;">
                                        <?php if ($u['status'] === 'active'): ?>
                                            <a class="action-btn danger"
                                                href="../actions/admin/disable_user.php?id=<?= $u['id'] ?>"
                                                onclick="return confirm('Disable this user?')">
                                                Disable
                                            </a>
                                        <?php else: ?>
                                            <a class="action-btn success"
                                                href="../actions/admin/enable_user.php?id=<?= $u['id'] ?>">
                                                Enable
                                            </a>
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
