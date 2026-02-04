<?php
session_start();
include "../includes/database.php";

// Sigurohuni që vetëm admin të hyjë
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

// Kur forma të dorëzohet
if (isset($_POST['submit'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (first_name, last_name, email, password, role)
            VALUES ('$first','$last','$email','$password','$role')";

    if (mysqli_query($connection, $sql)) {
        $successMessage = "User created successfully ✅";
    } else {
        $errorMessage = "Error creating user: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User - Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select {
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin: 10px 0;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        a.back {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: white;
            background-color: #6c757d;
            padding: 8px 15px;
            border-radius: 6px;
        }

        a.back:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create New User</h1>

        <?php if (!empty($successMessage)) : ?>
            <p class="message success"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <?php if (!empty($errorMessage)) : ?>
            <p class="message error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="submit">Create User</button>
        </form>

        <a href="dashboard.php" class="back">⬅ Back to Dashboard</a>
    </div>
</body>

</html>
