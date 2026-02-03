
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = basename($_SERVER['PHP_SELF']);

?>

<button class="menu-toggle" id="menuToggle">
  <span></span><span></span><span></span>
</button>
<div class="overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <h2>ParkFlow</h2>
    <span>User Panel</span>
  </div>

  <div class="user-info">
    Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
  </div>

  <ul class="sidebar-menu">
    <li class="<?= $current === 'dashboard.php' ? 'active' : '' ?>">
      <a href="<?= BASE_URL ?>/user/dashboard.php">Dashboard</a>
    </li>
    <li class="<?= $current === 'vehicles.php' ? 'active' : '' ?>">
      <a href="<?= BASE_URL ?>/user/vehicles.php">My Vehicles</a>
    </li>
    <li class="<?= $current === 'parking.php' ? 'active' : '' ?>">
      <a href="<?= BASE_URL ?>/user/parking.php">Parking</a>
    </li>
    <li class="<?= $current === 'parking_history.php' ? 'active' : '' ?>">
      <a href="<?= BASE_URL ?>/user/parking_history.php">Parking History</a>
    </li>
    <li class="logout">
      <a href="<?= BASE_URL ?>/actions/auth/logout.php">Logout</a>
    </li>
  </ul>
</aside>

<script>
const sidebar = document.getElementById('sidebar');
const toggle = document.getElementById('menuToggle');
const overlay = document.getElementById('overlay');

toggle.onclick = () => {
  sidebar.classList.toggle('open');
  overlay.classList.toggle('show');
};
overlay.onclick = () => {
  sidebar.classList.remove('open');
  overlay.classList.remove('show');
};
</script>
