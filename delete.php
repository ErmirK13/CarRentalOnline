<?php
session_start();
include "database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($connection, "DELETE FROM users WHERE id=$id");
header("Location: Dashboard.php");
