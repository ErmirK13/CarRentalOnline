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
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <?php include '../includes/header.php'; ?>

  <!-- SERVICES -->
  <section class="services-section">
    <h1>Our Cars</h1>

    <!-- FILTER BY TRANSMISSION -->
    <label for="transmissionFilter">Select by Transmission:</label>
    <select id="transmissionFilter">
      <option value="All">All</option>
      <option value="Manual">Manual</option>
      <option value="Automatic">Automatic</option>
    </select>

    <div class="services-container" id="cars-containers">
      <!-- CARD -->
      <div class="car-card">
        <img
          src="../images/cars/golf/car1.jpg"
          loading="lazy"
          onclick="viewCarDetails('VW Golf', 50, 'Economy', 'Manual',
          [
            '../images/cars/golf/car1.jpg',
            '../images/cars/golf/golf7.jpg'
          ])" />
        <h3>VW Golf</h3>
        <p>Economy · Manual</p>
        <span class="price">€50 / day</span>
        <button
          onclick="viewCarDetails('VW Golf', 50, 'Economy', 'Manual', [
          '../images/cars/golf/car1.jpg',
          '../images/cars/golf/golf7.jpg'
        ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/audi/car2.jpg"
          alt="Car"
          loading="lazy"
          onclick="viewCarDetails('Audi A4', 90, 'Sedan', 'Automatic',  [
            '../images/cars/audi/car2.jpg',
            '../images/cars/audi/audiA4.jpg'
          ])" />
        <h3>Audi A4</h3>
        <p>Sedan · Automatic</p>
        <span class="price">€90 / day</span>
        <button
          onclick="viewCarDetails('Audi A4', 90, 'Sedan', 'Automatic', [
            '../images/cars/audi/car2.jpg',
            '../images/cars/audi/audiA4.jpg'
          ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/bmw-x5/car3.jpg"
          loading="lazy"
          onclick="viewCarDetails('BMW X5', 120, 'Luxury SUV', 'Automatic', [
            '../images/cars/bmw-x5/car3.jpg',
            '../images/cars/bmw-x5/bmwX5.jpg',
          ])" />
        <h3>BMW X5</h3>
        <p>Luxury SUV · Automatic</p>
        <span class="price">€120 / day</span>
        <button
          onclick="viewCarDetails('BMW X5', 120, 'Luxury SUV', 'Automatic',  [
            '../images/cars/bmw-x5/car3.jpg',
            '../images/cars/bmw-x5/bmwX5.jpg'
          ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/tiguan/car4.jpg"
          alt="Car"
          loading="lazy"
          onclick="viewCarDetails('Tiguan R-Line', 50, 'Economy', 'Automatic',  [
            '../images/cars/tiguan/car4.jpg',
            '../images/cars/tiguan/tiguan.jpg',
          ])" />
        <h3>Tiguan R-Line</h3>
        <p>Economy · Automatic</p>
        <span class="price">€50 / day</span>
        <button
          onclick="viewCarDetails('Tiguan R-Line', 50, 'Economy', 'Automatic', [
            '../images/cars/tiguan/car4.jpg',
            '../images/cars/tiguan/tiguan.jpg'
          ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/mercedes/car5.jpg"
          alt="Car"
          loading="lazy"
          onclick="viewCarDetails('Mercedes S-Class', 50, 'Economy', 'Manual',  [
            '../images/cars/mercedes/car5.jpg',
            '../images/cars/mercedes/mercedes.jpg',
          ])" />
        <h3>Mercedes S-Class</h3>
        <p>Economy · Manual</p>
        <span class="price">€50 / day</span>
        <button
          onclick="viewCarDetails('Mercedes S-Class', 50, 'Economy', 'Manual', [
            '../images/cars/mercedes/car5.jpg',
            '../images/cars/mercedes/mercedes.jpg'
          ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/rangeRover/car6.jpg"
          alt="Car"
          loading="lazy"
          onclick="viewCarDetails('Range Rover Evoque', 50, 'Economy', 'Manual', [
            '../images/cars/rangeRover/car6.jpg',
            '../images/cars/rangeRover/rangerover.jpg'
          ])" />
        <h3>Range Rover Evoque</h3>
        <p>Economy · Manual</p>
        <span class="price">€50 / day</span>
        <button
          onclick="viewCarDetails('Range Rover Evoque', 50, 'Economy', 'Manual', [
            '../images/cars/rangeRover/car6.jpg',
            '../images/cars/rangeRover/rangerover.jpg'
          ])">
          Read more
        </button>
      </div>

      <div class="car-card">
        <img
          src="../images/cars/touareg/car7.jpg"
          alt="Car"
          loading="lazy"
          onclick="viewCarDetails('Touareg', 50, 'Economy', 'Manual', [
            '../images/cars/touareg/car7.jpg',
            '../images/cars/touareg/touareg.jpg'
          ])" />
        <h3>Touareg</h3>
        <p>Economy · Manual</p>
        <span class="price">€50 / day</span>
        <button
          onclick="viewCarDetails('Touareg', 50, 'Economy', 'Manual', [
            '../images/cars/touareg/car7.jpg',
            '../images/cars/touareg/touareg.jpg'
          ])">
          Read more
        </button>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include '../includes/footer.php'; ?>

  <script src="../js/index.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // FILTER BY TRANSMISSION
      const filterSelect = document.getElementById("transmissionFilter");
      const carCards = document.querySelectorAll(".car-card");

      filterSelect.addEventListener("change", () => {
        const value = filterSelect.value;

        carCards.forEach((card) => {
          const text = card.querySelector("p").textContent;
          if (value === "All" || text.includes(value)) {
            card.style.display = "block";
          } else {
            card.style.display = "none";
          }
        });
      });
    });
  </script>
</body>

</html>