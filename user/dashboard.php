<?php
session_start();
include "../includes/database.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$firstName = $_SESSION['first_name'];

if (isset($_GET['cancel_id'])) {
  $cancel_id = $_GET['cancel_id'];
  $delete_query = "DELETE FROM reservations WHERE id = '$cancel_id' AND user_id = '$user_id' AND status = 'Pending'";
  if (mysqli_query($conn, $delete_query)) {
    echo "<script>alert('Rezervimi u anulua!'); window.location.href='dashboard.php';</script>";
  }
}

if (isset($_POST['update_booking'])) {
  $b_id = $_POST['booking_id'];
  $new_loc = mysqli_real_escape_string($conn, $_POST['new_location']);
  mysqli_query($conn, "UPDATE reservations SET pickup_location = '$new_loc' WHERE id = '$b_id' AND user_id = '$user_id' AND status = 'Pending'");
  header("Location: dashboard.php");
}

$result = mysqli_query($conn, "SELECT * FROM reservations WHERE user_id = '$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Car Rental</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    :root {
      --primary: #007bff;
      --danger: #dc3545;
      --success: #28a745;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Arial;
      background: linear-gradient(135deg, #007bff, #00c6ff);
      min-height: 100vh;
      color: #333;
    }

    .header {
      background: white;
      padding: 15px 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      flex-wrap: wrap;
      gap: 10px;
    }

    .container {
      padding: 20px;
      max-width: 1100px;
      margin: auto;
    }

    .welcome-text {
      color: white;
      text-align: center;
      margin-bottom: 30px;
    }

    .bookings-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background: #f8f9fa;
      padding: 15px;
      text-align: left;
      border-bottom: 2px solid #eee;
    }

    td {
      padding: 15px;
      border-bottom: 1px solid #f0f0f0;
    }

    .badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
      display: inline-block;
    }

    .pending {
      background: #fff3cd;
      color: #856404;
    }

    .confirmed {
      background: #d4edda;
      color: #155724;
    }

    .btn-edit {
      color: var(--primary);
      text-decoration: none;
      font-weight: bold;
      margin-right: 15px;
    }

    .btn-cancel {
      color: var(--danger);
      text-decoration: none;
      font-weight: bold;
    }

    .logout-btn {
      background: var(--danger);
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .edit-form-container {
      background: #e9f2ff;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 5px solid var(--primary);
    }

    .edit-form {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .edit-form input {
      flex: 1;
      min-width: 200px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .edit-form button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .header {
        justify-content: center;
        text-align: center;
      }

      .container {
        padding: 10px;
      }

      table thead {
        display: none;
      }

      table tr {
        display: block;
        background: #fff;
        border: 1px solid #eee;
        margin-bottom: 15px;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      }

      table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        padding: 8px 10px;
        text-align: right;
        font-size: 14px;
      }

      table td::before {
        content: attr(data-label);
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        color: #777;
      }

      .btn-edit,
      .btn-cancel {
        display: inline-block;
        padding: 10px 0;
      }
    }
  </style>
</head>

<body>

  <div class="header">
    <div style="display:flex; align-items:center; gap:15px;">
      <a href="../pages/index.php" style="text-decoration:none; color:var(--primary); font-weight:bold;">← Home</a>
      <h3 style="margin:0;">Hi, <?php echo $firstName; ?></h3>
    </div>
    <a href="../auth/logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="container">
    <div class="welcome-text">
      <h1>My Bookings</h1>
      <p>Manage your car rentals on any device.</p>
    </div>

    <?php if (isset($_GET['edit_id'])): ?>
      <div class="edit-form-container">
        <h4 style="margin:0 0 10px 0;">Update Location for #<?php echo $_GET['edit_id']; ?></h4>
        <form method="POST" class="edit-form">
          <input type="hidden" name="booking_id" value="<?php echo $_GET['edit_id']; ?>">
          <input type="text" name="new_location" value="<?php echo $_GET['loc']; ?>" required>
          <button type="submit" name="update_booking">Save Changes</button>
          <a href="dashboard.php" style="padding:10px; color:#666;">Cancel</a>
        </form>
      </div>
    <?php endif; ?>

    <div class="bookings-card">
      <table>
        <thead>
          <tr>
            <th>Location</th>
            <th>Dates</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td data-label="Location"><strong><?php echo $row['pickup_location']; ?></strong></td>
              <td data-label="Dates"><?php echo $row['pickup_date']; ?> <br> <small><?php echo $row['return_date']; ?></small></td>
              <td data-label="Status">
                <span class="badge <?php echo ($row['status'] == 'Confirmed' ? 'confirmed' : 'pending'); ?>">
                  <?php echo $row['status']; ?>
                </span>
              </td>
              <td data-label="Actions">
                <?php if ($row['status'] == 'Pending'): ?>
                  <a href="dashboard.php?edit_id=<?php echo $row['id']; ?>&loc=<?php echo $row['pickup_location']; ?>" class="btn-edit">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="dashboard.php?cancel_id=<?php echo $row['id']; ?>" class="btn-cancel" onclick="return confirm('Are you sure?')">
                    <i class="fa fa-trash"></i> Cancel
                  </a>
                <?php else: ?>
                  <span style="color:#bbb;">No actions</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>