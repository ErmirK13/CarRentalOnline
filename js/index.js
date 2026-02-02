// TOGGLE MENU
document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");

  if (menuToggle && nav) {
    menuToggle.addEventListener("click", () => {
      nav.classList.toggle("active");
    });
  }
});

// TOGGLE PASSWORD
function togglePassword(inputId) {
  const input = document.getElementById(inputId);
  input.type = input.type === "password" ? "text" : "password";
}

document.addEventListener("DOMContentLoaded", () => {
  fetch("../auth/login.php")
    .then((res) => res.text())
    .then((html) => {
      document.body.insertAdjacentHTML("beforeend", html);

      const signUp = document.getElementById("SignUp");
      const signIn = document.getElementById("SignIn");

      // open SignUp
      document.querySelectorAll(".register-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
          signUp.style.display = "flex";
        });
      });

      // switch SignUp -> SignIn
      document.getElementById("toSignIn").addEventListener("click", (e) => {
        e.preventDefault();
        signUp.style.display = "none";
        signIn.style.display = "flex";
      });

      // switch SignIn -> SignUp
      document.getElementById("toSignUp").addEventListener("click", (e) => {
        e.preventDefault();
        signIn.style.display = "none";
        signUp.style.display = "flex";
      });

      window.addEventListener("click", (e) => {
        if (e.target === signUp) signUp.style.display = "none";
        if (e.target === signIn) signIn.style.display = "none";
      });

      // VALIDATION – SIGN IN
      document.getElementById("SignInForm").addEventListener("submit", (e) => {
        let email = document.getElementById("loginEmail");
        let password = document.getElementById("passwordSignIn");

        let valid = validateSignInField(email) && validateSignInField(password);

        if (!valid) {
          e.preventDefault();
        }
      });

      ["loginEmail", "passwordSignIn"].forEach((id) => {
        document.getElementById(id).addEventListener("input", (e) => {
          validateSignInField(e.target);
        });
      });

      // VALIDATION – SIGN UP
      document.getElementById("SignUpform").addEventListener("submit", (e) => {
        const ids = [
          "firstName",
          "lastName",
          "emailSignUp",
          "passwordSignUp",
          "confirmPasswordSignUp",
        ];
        let valid = true;

        ids.forEach((id) => {
          if (!validateSignUpField(document.getElementById(id))) {
            valid = false;
          }
        });

        if (!valid) {
          e.preventDefault();
        }
      });

      [
        "firstName",
        "lastName",
        "emailSignUp",
        "passwordSignUp",
        "confirmPasswordSignUp",
      ].forEach((id) => {
        document.getElementById(id).addEventListener("input", (e) => {
          validateSignUpField(e.target);
        });
      });
    });
});

// VALIDATION FUNCTIONS

function validateSignInField(input) {
  const error = document.getElementById("registerError");
  error.textContent = "";

  let valid = true;

  if (input.id === "loginEmail") {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(input.value)) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent = "Invalid email address.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  if (input.id === "passwordSignIn") {
    if (input.value.length < 6) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent = "Password must be at least 6 characters long.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  return valid;
}

function validateSignUpField(input) {
  const error = document.getElementById("loginError");
  error.textContent = "";

  let valid = true;

  if (input.id === "firstName" || input.id === "lastName") {
    if (!/^[A-Za-z]{3,}$/.test(input.value)) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent =
        "First name and last name must contain at least 3 letters and no numbers.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  if (input.id === "emailSignUp") {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(input.value)) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent = "Invalid email address.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  if (input.id === "passwordSignUp") {
    const passRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*(),.?":{}|<>]).{6,}$/;
    if (!passRegex.test(input.value)) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent =
        "Password must contain at least 6 characters, one number, and one symbol.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  if (input.id === "confirmPasswordSignUp") {
    const password = document.getElementById("passwordSignUp").value;
    if (input.value !== password) {
      input.classList.add("error");
      input.classList.remove("valid");
      valid = false;
      error.textContent = "Passwords do not match.";
    } else {
      input.classList.remove("error");
      input.classList.add("valid");
    }
  }

  return valid;
}

// CONTACT FORM VALIDATION

document.addEventListener("DOMContentLoaded", () => {
  const contactForm = document.getElementById("contactForm");

  if (contactForm) {
    const nameInput = document.getElementById("Name");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");

    let errorP = document.createElement("p");
    errorP.id = "contactError";
    errorP.style.color = "red";
    contactForm.appendChild(errorP);

    function validateContactField(input) {
      let valid = true;

      if (input.id === "Name") {
        if (!/^[A-Za-z\s]{3,}$/.test(input.value)) {
          input.classList.add("error");
          input.classList.remove("valid");
          valid = false;
          errorP.textContent =
            "Name must contain at least 3 letters and no numbers.";
        } else {
          input.classList.remove("error");
          input.classList.add("valid");
          errorP.textContent = "";
        }
      }

      if (input.id === "email") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
          input.classList.add("error");
          input.classList.remove("valid");
          valid = false;
          errorP.textContent = "Invalid email address.";
        } else {
          input.classList.remove("error");
          input.classList.add("valid");
          errorP.textContent = "";
        }
      }

      if (input.id === "message") {
        if (input.value.length < 10) {
          input.classList.add("error");
          input.classList.remove("valid");
          valid = false;
          errorP.textContent = "Message must be at least 10 characters long.";
        } else {
          input.classList.remove("error");
          input.classList.add("valid");
          errorP.textContent = "";
        }
      }
      return valid;
    }

    [nameInput, emailInput, messageInput].forEach((input) => {
      if (input) {
        input.addEventListener("input", (e) => validateContactField(e.target));
      }
    });

    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();
      let isValid = true;

      [nameInput, emailInput, messageInput].forEach((input) => {
        if (!validateContactField(input)) isValid = false;
      });

      if (isValid) {
        alert("Message sent successfully ✅");
        contactForm.reset();
        [nameInput, emailInput, messageInput].forEach((input) =>
          input.classList.remove("valid"),
        );
        errorP.textContent = "";
      }
    });
  }
});
// TOGGLE PASSWORD
function togglePassword(id) {
  const input = document.getElementById(id);
  input.type = input.type === "password" ? "text" : "password";
}

// VIEW CAR DETAILS
function viewCarDetails(name, price, type, transmission, images) {
  const car = { name, price, type, transmission, images };

  localStorage.setItem("selectedCar", JSON.stringify(car));
  window.location.href = "car-details.php";
}

// BACK TO TOP BUTTON
const backToTop = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
  if (window.scrollY > 200) {
    backToTop.style.display = "flex";
  } else {
    backToTop.style.display = "none";
  }
});

const back = document.getElementById("backToTop");

if (back) {
  back.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}
