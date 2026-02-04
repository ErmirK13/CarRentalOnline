<?php
session_start();
include "../includes/database.php";

$errorMessage = "";

if (isset($_POST['submit'])) {

    $email = $_POST['loginEmail'];
    $password = $_POST['passwordSignIn'];

    if (empty($email) || empty($password)) {
        $errorMessage = "Plotëso të gjitha fushat!";
    } else {

        // Përdor prepared statement për siguri
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['first_name'] = $user['first_name'];

                // Redirect sipas roli
                if ($user['role'] === 'admin') {
                    header("Location: ../dashboard/dashboard.php");
                } else {
                    header("Location: ../dashboard/user-dashboard.php");
                }
                exit;
            } else {
                $errorMessage = "Password i gabuar!";
            }
        } else {
            $errorMessage = "Ky email nuk ekziston!";
        }
        $stmt->close();
    }
}
?>
