<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CarRentalOnline</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
  <!-- Header -->
  <?php include '../includes/header.php'; ?>

  <!-- Home Section -->
  <section class="home">
    <div class="home-container">
      <div class="home-text">
        <h1>
          <span>BEST CAR</span><br />
          RENTAL DEALS<br />
          TODAY!
        </h1>
        <p>
          Rent the best cars at the best prices. Easy booking,fast pickup, and
          trusted service.
        </p>
        <div class="home-search">
          <input type="text" placeholder="Pick-up Location" />
          <input type="date" />
          <input type="date" />
          <button class="search">Search Now</button>
        </div>
      </div>
      <div class="home-image">
        <img src="../images/Home.jpg" alt="Rental Car" />
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section id="about" class="about-us-cards">
    <h2>How It Works</h2>
    <div class="how-it-works-section">
      <div class="card location">
        <div class="card-header">
          <i class="fa-solid fa-location-dot"></i>
          <h2>Location & Search</h2>
        </div>
        <ul>
          <li>
            Select your pick-up location, which can be a city center, airport,
            or a specific drop-off point.
          </li>
          <li>
            Enter the start and end dates of your rental period to search for
            available cars.
          </li>
        </ul>
      </div>

      <div class="card booking">
        <div class="card-header">
          <i class="fa-solid fa-hand-pointer"></i>
          <h2>Booking & Payment</h2>
        </div>
        <ul>
          <li>
            Choose a car that fits your needs and add any optional extras.
          </li>
          <li>
            Complete the reservation directly through our website and finalize
            the payment online.
          </li>
          <li>
            You will receive a confirmation email containing your voucher, the
            rental company's details, and pick-up instructions.
          </li>
        </ul>
      </div>

      <div class="card pickup">
        <div class="card-header">
          <i class="fa-solid fa-car"></i>
          <h2>Pick-Up & Drive</h2>
        </div>
        <ul>
          <li>
            At the counter, you will need to present your voucher,
            passport/ID, driver's license, and a credit card.
          </li>
          <li>
            Sign the rental agreement, collect the keys, and enjoy your
            journey!
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials">
    <h2>What Our Clients Say</h2>

    <div class="testimonial-slider">
      <button class="prev">
        <i class="fa-solid fa-chevron-left"></i>
      </button>

      <div class="testimonial-card active">
        <div class="avatar-user">
          <i class="fa-solid fa-user"></i>
        </div>

        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>

        <p>
          "Amazing service! The car was clean and ready on time. Highly
          recommended!"
        </p>
        <h4>John Doe</h4>
        <span>Prishtina</span>
      </div>

      <div class="testimonial-card">
        <div class="avatar-user">
          <i class="fa-solid fa-user"></i>
        </div>

        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-regular fa-star"></i>
        </div>

        <p>
          "Very easy booking process and friendly staff. Will rent again!"
        </p>
        <h4>Anna Smith</h4>
        <span>Tirana</span>
      </div>

      <div class="testimonial-card">
        <div class="avatar-user">
          <i class="fa-solid fa-user"></i>
        </div>

        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>

        <p>"Best car rental experience so far. Great prices and support!"</p>
        <h4>Mark Johnson</h4>
        <span>Skopje</span>
      </div>

      <button class="next">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </section>

  <!-- Footer -->
  <?php include '../includes/footer.php'; ?>

  <!-- -- JavaScript Files -->
  <script src="../js/index.js"></script>
  <script>
    const testimonials = document.querySelectorAll(".testimonial-card");
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");

    let currentIndex = 0;

    function showTestimonial(index) {
      testimonials.forEach((item) => item.classList.remove("active"));
      testimonials[index].classList.add("active");
    }

    nextBtn.addEventListener("click", () => {
      currentIndex++;
      if (currentIndex >= testimonials.length) {
        currentIndex = 0;
      }
      showTestimonial(currentIndex);
    });

    prevBtn.addEventListener("click", () => {
      currentIndex--;
      if (currentIndex < 0) {
        currentIndex = testimonials.length - 1;
      }
      showTestimonial(currentIndex);
    });
  </script>
</body>

</html>