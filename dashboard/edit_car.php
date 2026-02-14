<?php
session_start();
include "../includes/database.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM cars WHERE id=$id");
$car = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $transmission = $_POST['transmission'];

    mysqli_query($conn,"
        UPDATE cars SET
        name='$name',
        price='$price',
        type='$type',
        transmission='$transmission'
        WHERE id=$id
    ");

    header("Location: read_cars.php");
}
?>

<form method="POST">
    <input name="name" value="<?= $car['name'] ?>">
    <input name="price" value="<?= $car['price'] ?>">
    <input name="type" value="<?= $car['type'] ?>">

    <select name="transmission">
        <option <?= $car['transmission']=="Manual"?"selected":"" ?>>Manual</option>
        <option <?= $car['transmission']=="Automatic"?"selected":"" ?>>Automatic</option>
    </select>

    <button name="update">Update</button>
</form>
