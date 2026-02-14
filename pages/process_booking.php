<?php
session_start();
include "../includes/database.php";

if (isset($_POST['submit_booking'])) {

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in to reserve!'); window.location.href='../auth/login.php';</script>";
        exit;
    }

    // 🟢 Merr të dhënat nga form
    $user_id = $_SESSION['user_id'];
    $car_id = isset($_POST['car_id']) ? mysqli_real_escape_string($conn, $_POST['car_id']) : null;
    $location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
    $p_date = $_POST['pickup_date'];
    $r_date = $_POST['return_date'];

    if (!$car_id) {
        echo "<script>alert('Car ID is missing!'); window.history.back();</script>";
        exit;
    }

    // 🟢 Kontrollo nëse datat janë të lira për këtë veturë
    $check_query = "SELECT * FROM reservations 
                    WHERE car_id = '$car_id' 
                    AND ('$p_date' <= return_date AND '$r_date' >= pickup_date)";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Error checking reservation: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Sorry! These dates are taken. Please choose other dates.');
                window.history.back();
              </script>";
    } else {
        $insert_query = "INSERT INTO reservations 
                        (user_id, car_id, pickup_location, pickup_date, return_date, status) 
                        VALUES ('$user_id', '$car_id', '$location', '$p_date', '$r_date', 'Pending')";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>
                    alert('Reservation completed successfully!');
                    window.location.href='../pages/index.php';
                  </script>";
        } else {
            die("Error: " . mysqli_error($conn));
        }
    }
}
?>
