<?php
include "../includes/database.php";
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "DELETE FROM reservations WHERE id = $id";
  mysqli_query($conn, $query);

  header("Location: admin.php");
  exit();
}
