<?php
session_start();
include "database.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Details</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }

    /* Back button */
    .back-btn {
      display: inline-block;
      margin: 20px;
      font-size: 16px;
      color: #2072ef;
      text-decoration: none;
      font-weight: bold;
    }

    .back-btn i {
      margin-right: 8px;
    }

    /* Car Details Section */
    .car-details-section {
      max-width: 1100px;
      margin: 20px auto;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-wrap: wrap;
      overflow: hidden;
      padding: 20px;
      gap: 20px;
    }

    /* Gallery */
    .car-gallery {
      flex: 1;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .car-gallery img.main {
      width: 100%;
      border-radius: 8px;
      object-fit: cover;
      transition: transform 0.3s;
    }

    .car-gallery img.main:hover {
      transform: scale(1.05);
    }

    /* Car Info */
    .car-info {
      flex: 1;
      padding: 20px;
    }

    .car-info h1 {
      font-size: 32px;
      margin-bottom: 10px;
      color: #2072ef;
    }

    .car-info .rating {
      margin-bottom: 15px;
      color: #f39c12;
    }

    .car-info p {
      font-size: 16px;
      margin: 8px 0;
      color: #555;
    }

    .car-info .price {
      font-size: 24px;
      font-weight: bold;
      color: #2072ef;
      margin: 15px 0;
    }

    .car-info button {
      padding: 12px 25px;
      background: #2072ef;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
      margin-right: 10px;
    }

    .car-info button:hover {
      background: #0053d1;
    }

    /* Features Section */
    .car-features {
      display: flex;
      flex-wrap: wrap;
      margin-top: 20px;
      gap: 10px;
    }

    .car-features div {
      flex: 1 1 120px;
      padding: 10px;
      background: #f1f5ff;
      border-radius: 8px;
      text-align: center;
      font-size: 14px;
      color: #2072ef;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .car-details-section {
        flex-direction: column;
      }

      .car-info h1 {
        font-size: 26px;
      }

      .car-info p {
        font-size: 14px;
      }

      .car-info .price {
        font-size: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Back to Services -->
  <a href="services.php" class="back-btn">
    <i class="fa-solid fa-arrow-left"></i> Back to Services
  </a>

  <!-- Car Details Section -->
  <section class="car-details-section">
    <div class="car-gallery" id="carGallery"></div>

    <div class="car-info">
      <h1 id="carName"></h1>
      <div class="rating">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-regular fa-star"></i>
      </div>
      <p id="carType"></p>
      <p id="carTransmission"></p>
      <p class="price">€<span id="carPrice"></span> / day</p>
      <button class="book-btn">Book Now</button>

      <div class="car-features">
        <div>Seats: 5</div>
        <div>Luggage: 3</div>
        <div>Fuel: Petrol</div>
        <div>Doors: 4</div>
        <div>AC: Yes</div>
      </div>
    </div>
  </section>

  <script>
    const car = JSON.parse(localStorage.getItem("selectedCar"));

    if (car) {
      document.getElementById("carName").textContent = car.name;
      document.getElementById("carPrice").textContent = car.price;
      document.getElementById("carType").textContent = "Type: " + car.type;
      document.getElementById("carTransmission").textContent =
        "Transmission: " + car.transmission;

      const gallery = document.getElementById("carGallery");
      gallery.innerHTML = "";

      // Main image
      const mainImg = document.createElement("img");
      mainImg.src = car.images[0];
      mainImg.classList.add("main");
      mainImg.loading = "lazy";
      gallery.appendChild(mainImg);

      // Container for thumbnails
      const thumbContainer = document.createElement("div");
      thumbContainer.style.display = "flex";
      thumbContainer.style.flexWrap = "nowrap";
      thumbContainer.style.gap = "10px";
      thumbContainer.style.marginTop = "10px";
      thumbContainer.style.overflowX = "auto";
      thumbContainer.style.WebkitOverflowScrolling = "touch";
      gallery.appendChild(thumbContainer);

      thumbContainer.classList.add("thumb-container");
      gallery.appendChild(thumbContainer);

      // Thumbnails
      car.images.forEach((src, index) => {
        const thumb = document.createElement("img");
        thumb.src = src;
        thumb.style.flex = "0 0 auto";
        thumb.style.width = "70px";
        thumb.style.height = "50px";
        thumb.style.objectFit = "cover";
        thumb.style.borderRadius = "8px";
        thumb.style.cursor = "pointer";
        thumb.style.border =
          index === 0 ? "2px solid #2072ef" : "2px solid transparent";

        thumb.addEventListener("click", () => {
          mainImg.src = src;
          Array.from(thumbContainer.children).forEach(
            (t) => (t.style.border = "2px solid transparent")
          );
          thumb.style.border = "2px solid #2072ef";
          thumb.scrollIntoView({
            behavior: "smooth",
            inline: "center"
          });
        });

        thumbContainer.appendChild(thumb);
      });
    } else {
      document.querySelector(".car-details-section").innerHTML =
        "<p>No car selected.</p>";
    }
  </script>
</body>

</html>