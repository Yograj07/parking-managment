<?php
require_once "../includes/auth.php";
if ($_SESSION['role'] !== 'user') {
    die("Access Denied");
}
?>
<h2>User Dashboard</h2>
<a href="../actions/logout.php" style="color:red;">Logout</a>