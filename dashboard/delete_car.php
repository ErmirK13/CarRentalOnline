<?php
session_start();
include "../includes/database.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM cars WHERE id=$id");

header("Location: read_cars.php");
