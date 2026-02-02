<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($connection, "DELETE FROM users WHERE id=$id");
header("Location: dashboard.php");
