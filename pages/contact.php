<?php
session_start();
include "../includes/database.php";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $sql = "INSERT INTO contact (name, email, message)
            VALUES ('$name', '$email', '$message')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Message sent successfully');</script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <?php include '../includes/header.php'; ?>

  <!-- Contact Us -->
  <section id="contact" class="contact-section">
    <div class="contact-container">
      <div class="contact-header">
        <h2>Contact</h2>
        <span class="script-subtitle">We want to hear from you</span>
      </div>

      <div class="contact-content">
        <div class="contact-form-wrapper">
          <p class="form-label">Send us an Email:</p>

          <form class="contact-form" id="contactForm" method="POST" action="contact.php">
            <input type="text" id="Name" placeholder="Name" name="name" required />
            <input
              type="email"
              id="email"
              placeholder="Email Address"
              name="email"
              required />
            <textarea
              id="message"
              placeholder="Message"
              rows="5"
              name="message"
              required></textarea>
            <button type="submit" class="contact-btn" name="submit">SEND</button>
          </form>
        </div>

        <div class="contact-info-wrapper">
          <div class="info-item">
            <i class="fa-solid fa-phone flip-icon"></i>
            <span class="info-label">PHONE:</span>
            <span class="info-value">0468 957 987</span>
          </div>

          <div class="info-item">
            <i class="fa-solid fa-at"></i>
            <span class="info-label">EMAIL:</span>
            <span class="info-value">info@rentcar.com</span>
          </div>

          <div class="contact-socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include '../includes/footer.php'; ?>

  <script src="../js/index.js"></script>
</body>

</html>