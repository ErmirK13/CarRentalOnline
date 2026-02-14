<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  header("Location: ../auth/login.php");
  exit;
}

$firstName = $_SESSION['first_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>

  <style>
    body {
      margin: 0;
      font-family: Arial;
      background: linear-gradient(135deg, #007bff, #00c6ff);
    }

    .header {
      background: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
    }

    .container {
      padding: 40px;
      text-align: center;
      color: white;
    }

    .card {
      background: white;
      color: black;
      padding: 25px;
      border-radius: 10px;
      margin: 15px auto;
      width: 300px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, .15);
    }

    a.btn {
      background: red;
      color: white;
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 6px;
    }
  </style>
</head>

<body>

  <div class="header">

    <div style="display:flex; align-items:center; gap:15px;">

      <!-- BACK TO HOME -->
      <a href="../pages/index.php" style="
      text-decoration:none;
      font-size:20px;
      font-weight:bold;
      color:#007bff;
    ">
        ← Home
      </a>

      <h3>Hello, <?php echo $firstName; ?></h3>

    </div>
    <a class="btn" href="../auth/logout.php">Logout</a>
  </div>

  <div class="container">
    <h2>User Dashboard</h2>

    <div class="card">Browse Cars</div>
    <div class="card">My Bookings</div>
    <div class="card">Profile Settings</div>
  </div>

</body>
</html>