<?php
define('BASE_URL', '/parking-managment');
date_default_timezone_set('Asia/Kolkata');

$conn = mysqli_connect("localhost", "root", "", "parking_managment");
if (!$conn) {
    die("DB Connection Failed");
}
mysqli_set_charset($conn, "utf8mb4");
