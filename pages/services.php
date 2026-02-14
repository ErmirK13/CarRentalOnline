<?php
session_start();
include "../includes/database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <style>
    /* Upload Form */
    #uploadFormContainer {
      display: none;
      background: #f5f6fa;
      padding: 20px;
      max-width: 500px;
      margin: 20px auto;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    #uploadFormContainer input,
    #uploadFormContainer select,
    #uploadFormContainer button {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    #uploadBtn {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background: #2072ef;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    #uploadBtn:hover {
      background: #0053d1;
    }

    .read-more-btn {
      display: inline-block;
      padding: 8px 15px;
      background: #2072ef;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      margin-top: 5px;
    }

    .read-more-btn:hover {
      background: #0053d1;
    }
  </style>
</head>

<body>
  <?php include '../includes/header.php'; ?>

  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <button id="uploadBtn"><i class="fa-solid fa-upload"></i> Upload New Car</button>
    <div id="uploadFormContainer">
      <form method="POST" enctype="multipart/form-data" action="upload_car.php">
        <input type="text" name="name" placeholder="Car Name" required>
        <input type="number" name="price" placeholder="Price per day" required>
        <input type="text" name="type" placeholder="Car Type (e.g., Sedan, SUV)" required>
        <select name="transmission" required>
          <option value="Manual">Manual</option>
          <option value="Automatic">Automatic</option>
        </select>
        <input type="file" name="images[]" multiple required>
        <button type="submit" name="add_car">Add Car</button>
      </form>
    </div>
  <?php endif; ?>


  <section class="services-section">
    <h1>Our Cars</h1>

    <label for="transmissionFilter">Select by Transmission:</label>
    <select id="transmissionFilter">
      <option value="All">All</option>
      <option value="Manual">Manual</option>
      <option value="Automatic">Automatic</option>
    </select>

    <div class="services-container" id="cars-containers">
      <?php
      $result = $conn->query("SELECT * FROM cars");
      while ($row = $result->fetch_assoc()):
        $images = json_decode($row['images']);
      ?>
        <div class="car-card">
          <img src="<?php echo $images[0]; ?>" loading="lazy" alt="<?php echo $row['name']; ?>" />
          <h3><?php echo $row['name']; ?></h3>
          <p><?php echo $row['type']; ?> · <?php echo $row['transmission']; ?></p>
          <span class="price">€<?php echo $row['price']; ?> / day</span>
          <a href="car-details.php?car_id=<?php echo $row['id']; ?>" class="read-more-btn">Read more</a>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <?php include '../includes/footer.php'; ?>

  <script>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      document.getElementById("uploadBtn").addEventListener("click", function() {
        const form = document.getElementById("uploadFormContainer");
        form.style.display = form.style.display === "none" ? "block" : "none";
      });
    <?php endif; ?>

    document.addEventListener("DOMContentLoaded", () => {
      const filterSelect = document.getElementById("transmissionFilter");
      const carCards = document.querySelectorAll(".car-card");

      filterSelect.addEventListener("change", () => {
        const value = filterSelect.value;
        carCards.forEach((card) => {
          const text = card.querySelector("p").textContent;
          card.style.display = (value === "All" || text.includes(value)) ? "block" : "none";
        });
      });
    });
  </script>
</body>

</html>