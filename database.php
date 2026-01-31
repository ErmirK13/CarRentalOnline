<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Lidhja me databaze deshtoi: " . mysqli_connect_error());
}
?>