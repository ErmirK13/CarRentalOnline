<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $transmission = $_POST['transmission'];

    // IMAGE UPLOAD
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $path = "../images/cars/" . $image;
    move_uploaded_file($tmp, $path);

    $sql = "INSERT INTO cars (name, price, type, transmission, image_path)
            VALUES ('$name','$price','$type','$transmission','$image')";

    mysqli_query($conn, $sql);
}
?>

<h1>Create Car</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Car name" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="text" name="type" placeholder="Type">

    <select name="transmission">
        <option>Manual</option>
        <option>Automatic</option>
    </select>

    <input type="file" name="image" required>

    <button type="submit" name="submit">Create</button>
</form>
