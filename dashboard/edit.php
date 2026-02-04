<?php
session_start();
include "../includes/database.php";

// Sigurohu që vetëm admin mund të hyjë
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

$errorMessage = "";

// Merr ID e userit nga URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']);

// Merr të dhënat ekzistuese të userit
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
if (!$result || mysqli_num_rows($result) != 1) {
    header("Location: dashboard.php");
    exit();
}

$user = mysqli_fetch_assoc($result);

// Përditësim form
if (isset($_POST['update'])) {
    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $role = $_POST['role'];

    if (empty($first) || empty($last) || empty($role)) {
        $errorMessage = "Plotëso të gjitha fushat!";
    } else {
        $sql = "UPDATE users SET first_name='$first', last_name='$last', role='$role' WHERE id=$id";
        if (mysqli_query($connection, $sql)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessage = "Gabim gjatë përditësimit: " . mysqli_error($connection);
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
body { font-family: Arial; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
.edit-container { background: white; padding: 25px 30px; border-radius: 12px; width: 380px; box-shadow: 0 0 15px rgba(0,0,0,0.15); }
.edit-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
.edit-container input, .edit-container select { width: 100%; padding: 9px; margin: 6px 0 12px; border: 1px solid #ccc; border-radius: 5px; }
.edit-container input:focus, .edit-container select:focus { outline: none; border-color: #007bff; }
.edit-container button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
.edit-container button:hover { background: #218838; }
.edit-container a { display: block; text-align: center; margin-top: 10px; text-decoration: none; background: #dc3545; color: white; padding: 8px; border-radius: 6px; }
.edit-container a:hover { background: #c82333; }
.error { color: red; text-align: center; margin-bottom: 10px; }
</style>
</head>
<body>

<div class="edit-container">
    <h2>Edit User</h2>

    <?php if (!empty($errorMessage)) : ?>
        <div class="error"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        <select name="role" required>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <button name="update">Update</button>
    </form>

    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
