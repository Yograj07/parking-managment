<?php

define('BASE_URL', '/parking-managment');
date_default_timezone_set('Asia/Kolkata');
// configure DATABASE 
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "parking_managment";

// Create dabase connection 
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
    die("<script>console.log('Database connection failed')</script>" . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
