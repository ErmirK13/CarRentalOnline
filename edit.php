<?php
include "database.php";

$id = "";
$first_name = "";
$last_name = "";
$email = "";
$role = "";
$errorMessage = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: index.php");
        exit;
    }

    $first_name = $row['first_name'];
    $last_name  = $row['last_name'];
    $email      = $row['email'];
    $role       = $row['role'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id         = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $role       = $_POST['role'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($role)) {
        $errorMessage = "Te gjitha fushat duhet te plotesohen!";
    } else {
        $sql = "UPDATE users 
                SET first_name='$first_name', last_name='$last_name', email='$email', role='$role' 
                WHERE id=$id";

        if ($connection->query($sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = "Gabim gjate update: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.edit-container {
    background: white;
    padding: 25px 30px;
    border-radius: 12px;
    width: 380px;
    box-shadow: 0 0 15px rgba(0,0,0,0.15);
}

.edit-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.edit-container label {
    font-weight: bold;
    color: #555;
}

.edit-container input {
    width: 100%;
    padding: 9px;
    margin: 6px 0 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.edit-container input:focus {
    outline: none;
    border-color: #007bff;
}

.edit-container button {
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

.edit-container button:hover {
    background: #218838;
}

.edit-container a {
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    background: #dc3545;
    color: white;
    padding: 8px;
    border-radius: 6px;
}

.edit-container a:hover {
    background: #c82333;
}

.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>

</head>
<body>

<div class="edit-container">
    <h2>Edit User</h2>

    <?php if (!empty($errorMessage)) : ?>
        <div class="error"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label>First Name</label>
        <input type="text" name="first_name" value="<?= $first_name ?>">

        <label>Last Name</label>
        <input type="text" name="last_name" value="<?= $last_name ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= $email ?>">

        <label>Role</label>
        <input type="text" name="role" value="<?= $role ?>">

        <button type="submit">Update</button>
        <a href="index.php">Cancel</a>
    </form>
</div>

</body>
</html>
