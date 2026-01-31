<?php
session_start();
include "database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (first_name, last_name, email, password, role)
            VALUES ('$first','$last','$email','$password','$role')";

    mysqli_query($connection, $sql);
    header("Location: Dashboard.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<body>

    <!-- <h1>Create New User</h1>

    <form method="POST">
        <input type="text" name="first_name" placeholder="First name" required>
        <input type="text" name="last_name" placeholder="Last name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="submit">Create</button>
    </form>

    <a href="Dashboard.php">⬅ Back to Dashboard</a> -->

</body>

</html>