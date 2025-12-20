// MENU TOGGLE
document.getElementById("menuToggle").onclick = function () {
  var nav = document.getElementById("mainNav");
  nav.classList.toggle("active");
};

// GLOBAL ELEMENTS
const signInModal = document.getElementById("SignIn");
const signUpModal = document.getElementById("SignUp");

const toSignUp = document.getElementById("toSignUp");
const toSignIn = document.getElementById("toSignIn");

// initial state
signInModal.style.display = "flex";
signUpModal.style.display = "none";

// VIEW CAR DETAILS
function viewCarDetails(name, price, type, transmission, images) {
  const car = { name, price, type, transmission, images };

  localStorage.setItem("selectedCar", JSON.stringify(car));
  window.location.href = "car-details.html";
}

// TOGGLE PASSWORD
function togglePassword(inputId) {
  const input = document.getElementById(inputId);
  input.type = input.type === "password" ? "text" : "password";
}

// DOM CONTENT LOADED
document.addEventListener("DOMContentLoaded", () => {
  const signUpForm = document.getElementById("SignUpform");
  const signInForm = document.getElementById("SignInForm");

  // LOGIN BUTTON → OPEN SIGN IN
  document.querySelectorAll(".login-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      signUpModal.style.display = "none";
      signInModal.style.display = "flex";
    });
  });

  // SWITCH MODALS
  if (toSignUp) {
    toSignUp.addEventListener("click", (e) => {
      e.preventDefault();
      signInModal.style.display = "none";
      signUpModal.style.display = "flex";
    });
  }

  if (toSignIn) {
    toSignIn.addEventListener("click", (e) => {
      e.preventDefault();
      signUpModal.style.display = "none";
      signInModal.style.display = "flex";
    });
  }

  // CLOSE MODAL (CLICK OUTSIDE)
  window.addEventListener("click", (e) => {
    if (e.target === signUpModal) signUpModal.style.display = "none";
    if (e.target === signInModal) signInModal.style.display = "none";
  });

  // SIGN UP VALIDATION
  signUpForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const firstName = document.getElementById("firstName");
    const lastName = document.getElementById("lastName");
    const email = document.getElementById("emailSignUp");
    const password = document.getElementById("passwordSignUp");
    const confirmPassword = document.getElementById("confirmPasswordSignUp");
    const checkbox = signUpForm.querySelector("input[type='checkbox']");

    if (firstName.value.length < 3 || lastName.value.length < 3) {
      alert("First and Last name must have at least 3 characters");
      return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
      alert("Email is not valid");
      return;
    }

    const passRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*]).{6,}$/;
    if (!passRegex.test(password.value)) {
      alert("Password must be 6+ chars, include a number and a symbol");
      return;
    }

    if (password.value !== confirmPassword.value) {
      alert("Passwords do not match");
      return;
    }

    if (!checkbox.checked) {
      alert("You must agree to Terms and Privacy Policy");
      return;
    }

    alert("Registration successful ✅");
    signUpForm.reset();
    signUpModal.style.display = "none";

    // REDIRECT TO HOME
    window.location.href = "index.html";
  });

  // SIGN IN VALIDATION
  signInForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const email = signInForm.querySelector("input[type='email']");
    const password = document.getElementById("passwordSignIn");

    if (!email.value || !password.value) {
      alert("Please fill all fields");
      return;
    }

    if (password.value.length < 6) {
      alert("Password must be at least 6 characters");
      return;
    }

    alert("Login successful ✅");
    signInForm.reset();
    signInModal.style.display = "none";

    // REDIRECT TO HOME
    window.location.href = "index.html";
  });
});

// BACK TO TOP BUTTON
const backToTop = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    backToTop.style.display = "flex";
  } else {
    backToTop.style.display = "none";
  }
});

backToTop.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});
