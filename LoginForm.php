<?php
session_start();
include "database.php";

$firstName = "";
$lastName = "";
$email = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login/Register Form</title>
  <link rel="stylesheet" href="css/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
  <!-- SignUp Form -->
  <div id="SignUp" class="modal">
    <div class="modalContent">
      <h2>Create an account</h2>

      <form id="SignUpform" method="POST" action="">
        <input type="text" name="firstName" id="firstName" placeholder="First Name" required />
        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required />
        <input type="email" name="emailSignUp" id="emailSignUp" placeholder="Email" required />

        <div class="passwordWrapper">
          <input
            type="password"
            id="passwordSignUp"
            name="password"
            placeholder="Password"
            required />
          <i
            class="fa-regular fa-eye toggle-password"
            onclick="togglePassword('passwordSignUp')"></i>
        </div>

        <div class="passwordWrapper">
          <input
            type="password"
            id="confirmPasswordSignUp"
            name="confirmPassword"
            placeholder="Confirm Password"
            required />
          <i
            class="fa-regular fa-eye toggle-password"
            onclick="togglePassword('confirmPasswordSignUp')"></i>
        </div>

        <!-- Checkbox for terms and conditions -->
        <label class="checkboxLabel">
          <input type="checkbox" required />
          <span>
            By registering an account, you agree
            <a href="#">Terms and conditions</a> and
            <a href="#">Privacy policy</a> *
          </span>
        </label>

        <button type="submit" class="submitBtn">Register</button>
        <p id="loginError" style="color: red; text-align: center"></p>
      </form>

      <p class="textSwitch">
        Already have an account? <a href="#" id="toSignIn">Sign In</a>
      </p>
    </div>
  </div>

  <!-- SignIn Form -->
  <div id="SignIn" class="modal">
    <div class="modalContent">
      <h2>Sign In</h2>

      <form id="SignInForm">
        <input type="email" id="loginEmail" placeholder="Email" required />

        <div class="passwordWrapper">
          <input
            type="password"
            id="passwordSignIn"
            placeholder="Password"
            required />
          <i
            class="fa-regular fa-eye toggle-password"
            onclick="togglePassword('passwordSignIn')"></i>
        </div>

        <p id="registerError" style="color: red; text-align: center"></p>
        <button type="submit" class="submitBtn">Sign In</button>
      </form>

      <p class="textSwitch">
        Don’t have an account? <a href="#" id="toSignUp">Sign Up</a>
      </p>
    </div>
  </div>

  <script src="js/index.js"></script>
</body>

</html>