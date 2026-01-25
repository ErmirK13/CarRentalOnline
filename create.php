<?php
include "database.php";

$errorMessage = "";
$successMessage = "";

// REGISTER (CREATE)
if (isset($_POST['submit'])) {

    $firstName = $_POST['firstname'];
    $lastName  = $_POST['lastname'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm'];

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirm)) {
        $errorMessage = "Te gjitha fushat duhet te plotesohen";
    } elseif ($password !== $confirm) {
        $errorMessage = "Password-et nuk perputhen";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, password)
                VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

        if ($connection->query($sql)) {
            $successMessage = "User u shtua me sukses";
        } else {
            $errorMessage = "Gabim: " . $connection->error;
        }
    }
}

// READ
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    padding:20px;
}
.container{
    width:900px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
h2{
    text-align:center;
}
form{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
    margin-bottom:20px;
}
form input{
    padding:8px;
}
form button{
    grid-column: span 2;
    padding:10px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:5px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#343a40;
    color:white;
    padding:8px;
}
td{
    padding:8px;
    text-align:center;
}
tr:nth-child(even){
    background:#f2f2f2;
}
.error{color:red;text-align:center;}
.success{color:green;text-align:center;}
</style>
</head>

<body>

<div class="container">

<h2>Shto User</h2>

<?php if($errorMessage): ?>
<p class="error"><?= $errorMessage ?></p>
<?php endif; ?>

<?php if($successMessage): ?>
<p class="success"><?= $successMessage ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="firstname" placeholder="First Name">
    <input type="text" name="lastname" placeholder="Last Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="confirm" placeholder="Confirm Password">
    <button type="submit" name="submit">Shto User</button>
</form>

<h2>Lista e Users</h2>

<table>
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Created</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['first_name'] ?></td>
    <td><?= $row['last_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</div>
</body>
</html>
