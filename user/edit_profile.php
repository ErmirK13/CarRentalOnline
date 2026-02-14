<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['update_profile'])) {
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $new_password = $_POST['new_password'];

  if (!empty($new_password)) {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$hashed_password' WHERE id = '$user_id'";
  } else {
    $update_query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$user_id'";
  }

  if (mysqli_query($conn, $update_query)) {
    $_SESSION['first_name'] = $first_name;

    header("Location: dashboard.php?update=success");
    exit;
  } else {
    $message = "<div class='alert error'>Gabim: " . mysqli_error($conn) . "</div>";
  }
}

$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile - Car Rental</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    :root {
      --primary: #007bff;
      --danger: #dc3545;
      --success: #28a745;
      --text-dark: #333;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Arial;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      min-height: 100vh;
      color: #333;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: white;
      padding: 15px 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header a {
      text-decoration: none;
      color: var(--primary);
      font-weight: bold;
      font-size: 16px;
    }

    .container {
      padding: 40px 20px;
      max-width: 500px;
      margin: auto;
      width: 100%;
    }

    .profile-card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .profile-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .profile-header i {
      font-size: 60px;
      color: var(--primary);
      margin-bottom: 10px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 8px;
      color: #555;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      font-size: 15px;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .btn-submit {
      width: 100%;
      background: var(--primary);
      color: white;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-submit:hover {
      background: #0056b3;
    }

    .alert {
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
    }

    .alert.success {
      background: #d4edda;
      color: #155724;
    }

    .alert.error {
      background: #f8d7da;
      color: #721c24;
    }

    .help-text {
      font-size: 12px;
      color: #777;
      margin-top: 5px;
      display: block;
    }
  </style>
</head>

<body>

  <div class="header">
    <a href="dashboard.php">
      <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
    </a>
  </div>

  <div class="container">
    <div class="profile-card">
      <div class="profile-header">
        <i class="fa-solid fa-circle-user"></i>
        <h2>Edit Profile</h2>
      </div>

      <?php if (!empty($message)) echo $message; ?>

      <form method="POST" action="">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
          <label>New Password</label>
          <input type="password" name="new_password" placeholder="••••••••">
          <span class="help-text">Leave blank if you don't want to change the password.</span>
        </div>

        <button type="submit" name="update_profile" class="btn-submit">
          <i class="fa-solid fa-save"></i> Save Changes
        </button>
      </form>
    </div>
  </div>

</body>

</html>