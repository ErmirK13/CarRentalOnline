<?php
include "database.php";

$errorMessage = "";

if (isset($_POST['submit'])) {

    $email = $_POST['loginEmail'];
    $password = $_POST['passwordSignIn'];

    if (empty($email) || empty($password)) {
        $errorMessage = "Plotëso të gjitha fushat!";
    } else {

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                header("Location: dashboard.php");
                exit;
            } else {
                $errorMessage = "Password i gabuar!";
            }
        } else {
            $errorMessage = "Ky email nuk ekziston!";
        }
    }
}
