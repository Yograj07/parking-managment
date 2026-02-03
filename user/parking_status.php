<?php
require_once __DIR__ . '/../config/db.php';
session_start();

header("Location: " . BASE_URL . "/user/parking.php");
exit;
