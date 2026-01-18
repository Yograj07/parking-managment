<?php
require_once "../includes/auth.php";
if ($_SESSION['role'] !== 'admin') {
    die("Access Denied");
}
?>

<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['username']; ?></p>

<a href="../actions/logout.php" style="color:red;">Logout</a>
