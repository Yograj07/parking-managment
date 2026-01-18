<div class="sidebar">
    <div class="brand">
    PARKING ADMIN
    </div>

    <ul>
        <li>
            <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF'])=='dashboard.php'?'active':'' ?>">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="manage_slots.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_slots.php'?'active':'' ?>">
                <i class="fa-solid fa-square-parking"></i>
                Parking Slots
            </a>
        </li>

        <li>
            <a href="manage_vehicles.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_vehicles.php'?'active':'' ?>">
                <i class="fa-solid fa-car-side"></i>
                Vehicles
            </a>
        </li>

        <li>
            <a href="manage_parking.php" class="<?= basename($_SERVER['PHP_SELF'])=='manage_parking.php'?'active':'' ?>">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                Entry / Exit
            </a>
        </li>

        <li>
            <a href="reports.php" class="<?= basename($_SERVER['PHP_SELF'])=='reports.php'?'active':'' ?>">
                <i class="fa-solid fa-chart-line"></i>
                Reports
            </a>
        </li>
    </ul>

    <div class="logout">
        <a href="../actions/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>
</div>
