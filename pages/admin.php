<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}
include "../includes/database.php";

$query = "SELECT * FROM reservations ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Panel - Reservations</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
    }

    .btn-confirm {
      color: white;
      background: green;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 3px;
    }

    .btn-delete {
      color: white;
      background: red;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 3px;
    }
  </style>
</head>

<body>

  <h2>All Reservations</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Pickup Location</th>
      <th>Pickup Date</th>
      <th>Return Date</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['pickup_location']; ?></td>
        <td><?php echo $row['pickup_date']; ?></td>
        <td><?php echo $row['return_date']; ?></td>
        <td><strong><?php echo $row['status']; ?></strong></td>
        <td>
          <?php if ($row['status'] == 'Pending') { ?>
            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-confirm">Konfirmo</a>
          <?php } ?>

          <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

</body>

</html>