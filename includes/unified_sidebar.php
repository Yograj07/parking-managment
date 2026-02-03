<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role = $_SESSION['role'] ?? 'guest';
$current = basename($_SERVER['PHP_SELF']);
$base = defined('BASE_URL') ? BASE_URL : '';
$username = $_SESSION['username'] ?? 'User';
?>

<!-- Toggle -->
<button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
    <span></span>
    <span></span>
    <span></span>
</button>

<div class="overlay" id="overlay"></div>

<div class="page-loader" id="pageLoader" aria-live="polite" aria-busy="true">
    <div class="loader-content">
        <span class="loader-logo">ParkFlow</span>
        <span class="loader-spinner"></span>
        <span class="loader-text">Loading dashboard</span>
    </div>
</div>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <h2>ParkFlow</h2>
        <span>
            <?= $role === 'admin' ? 'Admin Panel' : ($role === 'user' ? 'User Dashboard' : 'Welcome') ?>
        </span>
    </div>

    <?php if ($role === 'user'): ?>
        <div class="user-info">
            Welcome, <strong><?= htmlspecialchars($username) ?></strong>
        </div>
    <?php endif; ?>

    <ul class="sidebar-menu">

        <?php if ($role === 'admin'): ?>

            <li class="<?= $current === 'dashboard.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/admin/dashboard.php">Dashboard</a>
            </li>

            <li class="<?= $current === 'manage_slots.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/admin/manage_slots.php">Parking Slots</a>
            </li>

            <li class="<?= $current === 'manage_users.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/admin/manage_users.php">Users</a>
            </li>

            <li class="<?= $current === 'reports.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/admin/reports.php">Reports</a>
            </li>

        <?php elseif ($role === 'user'): ?>

            <li class="<?= $current === 'dashboard.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/user/dashboard.php">Dashboard</a>
            </li>

            <li class="<?= $current === 'vehicles.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/user/vehicles.php">My Vehicles</a>
            </li>

            <li class="<?= $current === 'parking.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/user/parking.php">Parking</a>
            </li>

            <li class="<?= $current === 'parking_history.php' ? 'active' : '' ?>">
                <a href="<?= $base ?>/user/parking_history.php">Parking History</a>
            </li>

        <?php else: ?>

            <li>
                <a href="<?= $base ?>/home.php">Home</a>
            </li>
            <li>
                <a href="<?= $base ?>/login.php">Login</a>
            </li>

        <?php endif; ?>

        <?php if ($role !== 'guest'): ?>
            <li class="logout">
                <a href="<?= $base ?>/actions/auth/logout.php">Logout</a>
            </li>
        <?php endif; ?>

    </ul>
</aside>

<?php if ($role === 'admin'): ?>
    <nav class="mobile-nav" aria-label="Quick navigation">
        <a class="<?= $current === 'dashboard.php' ? 'active' : '' ?>" href="<?= $base ?>/admin/dashboard.php">Dashboard</a>
        <a class="<?= $current === 'manage_slots.php' ? 'active' : '' ?>" href="<?= $base ?>/admin/manage_slots.php">Slots</a>
        <a class="<?= $current === 'manage_users.php' ? 'active' : '' ?>" href="<?= $base ?>/admin/manage_users.php">Users</a>
        <a class="<?= $current === 'reports.php' ? 'active' : '' ?>" href="<?= $base ?>/admin/reports.php">Reports</a>
    </nav>
<?php elseif ($role === 'user'): ?>
    <nav class="mobile-nav" aria-label="Quick navigation">
        <a class="<?= $current === 'dashboard.php' ? 'active' : '' ?>" href="<?= $base ?>/user/dashboard.php">Dashboard</a>
        <a class="<?= $current === 'vehicles.php' ? 'active' : '' ?>" href="<?= $base ?>/user/vehicles.php">Vehicles</a>
        <a class="<?= $current === 'parking.php' ? 'active' : '' ?>" href="<?= $base ?>/user/parking.php">Parking</a>
        <a class="<?= $current === 'parking_history.php' ? 'active' : '' ?>" href="<?= $base ?>/user/parking_history.php">History</a>
    </nav>
<?php endif; ?>
