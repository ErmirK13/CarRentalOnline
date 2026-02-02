<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $role = $_POST['role'];

    mysqli_query(
        $connection,
        "UPDATE users SET first_name='$first', last_name='$last', role='$role' WHERE id=$id"
    );
    header("Location: dashboard.php");
}

$result = mysqli_query($connection, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
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

        <form method="POST">
            <input type="text" name="first_name" value="<?= $user['first_name'] ?>">
            <input type="text" name="last_name" value="<?= $user['last_name'] ?>">
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button name="update">Update</button>
        </form>

    </div>

</body>

</html>