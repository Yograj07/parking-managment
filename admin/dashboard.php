<?php
require_once "../includes/auth.php";
if ($_SESSION['role'] !== 'admin') {
    die("Access Denied");
}
?>
<?php include "../includes/admin_sidebar.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>
    <div class="main-content">
        <h1>Admin Dashboard</h1>

        <div class="card">
            <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></p>
        </div>
    </div>
    <a href="../actions/logout.php" style="color:red;">Logout</a>
</body>

</html>