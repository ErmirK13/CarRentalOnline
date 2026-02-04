<?php
session_start();
include "../includes/database.php";


$email = "";
$password = "";
$loginError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginEmail'])) {
  $emailLogin = $_POST['loginEmail'];
  $passwordLogin = $_POST['passwordSignIn'];
  

  $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$emailLogin'");

  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($passwordLogin, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['first_name'] = $user['first_name'];

      if ($user['role'] === 'admin') {
        header("Location: ../dashboard/dashboard.php");
      } else {
        header("Location: ../pages/index.php");
      }
      exit;
    } else {
      $loginError = "Passwordi nuk eshte korrekt";
    }
  } else {
    $loginError = "Ky email nuk ekziston";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - CarRentalOnline</title>
<link rel="stylesheet" href="../css/style.css">
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

  /* Login qendër */
  .login-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-page {
    background-color: #fff;
    border-radius: 15px;
    padding: 40px 30px;
    width: 400px;
    max-width: 90%;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    text-align: center;
  }

  .login-page h2 {
    color: #007bff;
    margin-bottom: 25px;
    font-size: 2em;
  }

  .login-page input {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1em;
  }

  .passwordWrapper {
    position: relative;
  }

  .passwordWrapper input {
    padding-right: 40px;
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
    width: 100%;
    padding: 14px;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 1.1em;
    cursor: pointer;
    margin-top: 15px;
    transition: 0.3s;
  }

  .submitBtn:hover {
    background-color: #0056b3;
  }

  #errorMessage {
    color: red;
    font-size: 0.9em;
    margin-bottom: 10px;
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
  .login-page input {
  width: 90%;
  padding: 16px 15px;    /* nga 12px 15px → më të vogla */
  margin: 8px 0;        /* pak më pak hapësirë mes inputeve */
  border-radius: 6px;   /* pak më e vogël se 8px */
  border: 1px solid #ccc;
     
}
 .login-page input:valid {
  border-color: #007bff; /* blu kur është i vlefshëm */
}

.login-page input.error {
  border-color: red; /* kuq kur ka gabim */
}

  @media (max-width: 480px) {
    .login-page {
      width: 90%;       /* zvogëlohet pak, mbetet në qendër */
    padding: 30px 20px;
    }
    .login-page h2 {
      font-size: 1.5em;
    }
   
   

  .login-page input {
    padding: 14px 12px; /* inputet pak më kompakte */
  }

  .submitBtn {
    padding: 12px;
    font-size: 1em;
  }
}

  
</style>
</head>
<body>

  <!-- Header -->
  <?php include '../includes/header.php'; ?>

  <div class="login-container">
    <div class="login-page">
      <h2>Login</h2>
    
      <form id="SignInForm" method="POST">
        <input type="email" name="loginEmail" id= "loginEmail" placeholder="Email" required>
        <div class="passwordWrapper">
          <input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password" required>
          <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('passwordSignIn')"></i>
        </div>
        <button type="submit" class="submitBtn">Sign In</button>
      </form>
      <p id="registerError" style="color: red; text-align: center"></p>
      <div class="textSwitch">
        Nuk ke llogari? <a href="signup.php">Regjistrohu</a>
      </div>
    </div>
  </div>
<?php if ($loginError): ?>
        <div id="errorMessage"><?php echo $loginError; ?></div>
      <?php endif; ?>

<script src="../js/index.js"></script>
</body>
</html>   