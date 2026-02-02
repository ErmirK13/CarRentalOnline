<header>
  <div class="header-container">
    <div class="brand">
      <div class="logo">
        <img class="logo-img" src="../images/logo.png" alt="Logo" />
      </div>
      <div class="brand-name">CarRental</div>
    </div>

    <button class="menu-toggle" aria-label="Toggle navigation" id="menuToggle">
      <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="main-nav" id="mainNav">
      <a href="../pages/index.php">Home</a>
      <a href="../pages/about.php">About</a>
      <a href="../pages/services.php">Services</a>
      <a href="../pages/contact.php">Contact</a>

      <!-- Login/Logout Links -->
      <?php
      if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="../dashboard/dashboard.php">Dashboard</a>
        <a href="../auth/logout.php" class="button">Logout</a>
      <?php elseif (isset($_SESSION['user_id'])): ?>
        <a href="../auth/logout.php" class="button">Logout</a>
      <?php else: ?>
        <a href="../auth/login.php" class="button">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>