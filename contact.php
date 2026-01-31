<?php
session_start();
include "database.php";

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
  <link rel="stylesheet" href="css/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="brand">
        <div class="logo">
          <img class="logo-img" src="images/logo.png" alt="Logo" />
        </div>
        <div class="brand-name">CarRental</div>
      </div>

      <button
        class="menu-toggle"
        aria-label="Toggle navigation"
        id="menuToggle">
        <i class="fa-solid fa-bars"></i>
      </button>

      <nav class="main-nav" id="mainNav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">Services</a>
        <a href="contact.php">Contact</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="Dashboard.php">Dashboard</a>
          <a href="logout.php" class="register-btn">Logout</a>
        <?php elseif (isset($_SESSION['user_id'])): ?>
          <a href="logout.php" class="register-btn">Logout</a>
        <?php else: ?>
          <a href="LoginForm.php" class="register-btn">Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

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
          <form class="contact-form" method="POST" action="contact.php">
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
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-left">
        <div class="footer-brand">CarRental</div>
        <p>
          Rent the best cars at the best prices. Easy booking, fast pickup,
          and trusted service.
        </p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="Twitter">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="footer-links">
        <div class="footer-column">
          <h4>Account</h4>
          <a href="#">Profile</a>
          <a href="#">Settings</a>
          <a href="#">Billing</a>
          <a href="#">Notifications</a>
        </div>
        <div class="footer-column">
          <h4>About</h4>
          <a href="#">Services</a>
          <a href="#">Pricing</a>
          <a href="#">Contact</a>
          <a href="#">Careers</a>
        </div>
        <div class="footer-column">
          <h4>Company</h4>
          <a href="#">Community</a>
          <a href="#">Help Center</a>
          <a href="#">Support</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 CarRental. All Rights Reserved.</p>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
      <i class="fa-solid fa-arrow-up"></i>
      TOP
    </a>
  </footer>

  <script src="js/index.js"></script>
</body>

</html>