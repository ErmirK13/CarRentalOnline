<?php
session_start();
include "../includes/database.php";

$firstName = "";
$lastName = "";
$email = "";
$password = "";
$errorMessage = "";
$successMessage = "";
$loginError = "";

// SignUp
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstName'])) {
  $firstName = $_POST['firstName'];
  $lastName  = $_POST['lastName'];
  $email     = $_POST['emailSignUp'];
  $password  = $_POST['password'];

  if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
    $errorMessage = "Te gjitha fushat duhet te plotesohen";
  } else {
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
      $errorMessage = "Ky email ekziston";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (first_name, last_name, email, password)
                    VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

      if (mysqli_query($conn, $sql)) {
        $successMessage = "Regjistrimi u krye me sukses";
      } else {
        $errorMessage = "Gabim gjate regjistrimit: " . mysqli_error($conn);
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - CarRentalOnline</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .signup-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
    }

    .signup-page {
      background-color: #fff;
      border-radius: 15px;
      padding: 40px 30px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .signup-page h2 {
      color: #007bff;
      margin-bottom: 25px;
      font-size: 2em;
    }

    .signup-page input {
      width: 90%;
      padding: 16px 15px;
      margin: 10px auto;
      display: block;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1em;
    }

    .passwordWrapper {
      position: relative;
    }

    .passwordWrapper input {
      width: 90;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #007bff;
    }

    .submitBtn {
      width: 80%;
      padding: 14px;
      background-color: #007bff;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 1.1em;
      cursor: pointer;
      margin-top: 15px;
      transition: 0.3s;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .submitBtn:hover {
      background-color: #0056b3;
    }

    #errorMessage,
    #successMessage {
      color: red;
      font-size: 0.9em;
      margin-bottom: 10px;
    }

    #successMessage {
      color: green;
    }

    .textSwitch {
      margin-top: 15px;
      font-size: 0.9em;
    }

    .textSwitch a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }

    .textSwitch a:hover {
      text-decoration: underline;
    }

    .checkboxLabel {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 80%;
      margin: 15px auto 0 auto;
      font-size: 0.95em;
      color: #333;
      cursor: pointer;
    }

    .checkboxLabel input[type="checkbox"] {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
    }

    .checkboxLabel span a {
      color: #007bff;
      text-decoration: none;
    }

    .checkboxLabel span a:hover {
      text-decoration: underline;
    }

    signup-page input:focus {
      border-color: #007bff;
      outline: none;
    }

    .signup-page input:valid {
      border-color: #007bff;
    }

    .signup-page input.error {
      border-color: red;
    }

    @media (max-width: 480px) {
      .signup-page {
        width: 90%;
        padding: 30px 20px;
      }

      .signup-page input,
      .submitBtn {
        width: 90%;
        padding: 14px;
      }
    }
  </style>
</head>

<body>

  <!-- Header -->
  <?php include '../includes/header.php'; ?>

  <div class="signup-container">
    <div class="signup-page">
      <h2>Create Account</h2>

      <form id="SignUpForm" method="POST">
        <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
        <input type="email" name="emailSignUp" id="emailSignUp" placeholder="Email" required>

        <div class="passwordWrapper">
          <input type="password" id="passwordSignUp" name="password" placeholder="Password" required>
          <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('passwordSignUp')"></i>
        </div>

        <div class="passwordWrapper">
          <input type="password" id="confirmPasswordSignUp" name="confirmPassword" placeholder="Confirm Password" required>
          <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('confirmPasswordSignUp')"></i>
        </div>

        <label class="checkboxLabel">
          <input type="checkbox" required>
          <span>By registering, you agree <a href="#">Terms</a> & <a href="#">Privacy</a> *</span>
        </label>

        <button type="submit" class="submitBtn">Register</button>
      </form>
      <p id="loginError" style="color: red; text-align: center"></p>
      <p class="textSwitch">
        Already have an account? <a href="login.php">Sign In</a>
      </p>
    </div>
  </div>
  <?php if ($errorMessage): ?>
    <div id="errorMessage"><?php echo $errorMessage; ?></div>
  <?php endif; ?>
  <?php if ($successMessage): ?>
    <div id="successMessage"><?php echo $successMessage; ?></div>
  <?php endif; ?>

  <script src="../js/index.js"></script>
</body>

</html>