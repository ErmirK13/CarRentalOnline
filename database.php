<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
  die("Lidhja me databaze deshtoi: " . mysqli_connect_error());
}
echo "Lidhja me databaze u realizua me sukses!";

?>