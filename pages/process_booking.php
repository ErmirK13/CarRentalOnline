<?php
session_start();
include "../includes/database.php";

if (isset($_POST['submit_booking'])) {
  if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to reserve!'); window.location.href='../auth/login.php';</script>";
    exit;
  }

  $location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
  $p_date = $_POST['pickup_date'];
  $r_date = $_POST['return_date'];
  $user_id = $_SESSION['user_id'];

  $check_query = "SELECT * FROM reservations 
                    WHERE ('$p_date' <= return_date AND '$r_date' >= pickup_date)";

  $check_result = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_result) > 0) {
    echo "<script>
                alert('Sorry! These dates are taken. Please choose other dates.');
                window.history.back();
              </script>";
  } else {
    $query = "INSERT INTO reservations (user_id, pickup_location, pickup_date, return_date, status) 
                  VALUES ('$user_id', '$location', '$p_date', '$r_date', 'Pending')";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Reservation completed successfully!'); window.location.href='../pages/index.php';</script>";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}
