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
document.addEventListener("DOMContentLoaded", () => {
  // ======================
  // TOGGLE PASSWORD
  // ======================
  function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
  }

  // Lidh toggle-password për të gjitha ikonat
  
  // ======================
  // LOGIN VALIDATION
  // ======================
  const loginForm = document.getElementById("SignInForm");
  if (loginForm) {
    const loginEmail = document.getElementById("loginEmail");
    const loginPassword = document.getElementById("passwordSignIn");
    const loginErrorDiv = document.getElementById("registerError");

    loginForm.addEventListener("submit", () => {
      validateLoginField(loginEmail);
      validateLoginField(loginPassword);
    });

    [loginEmail, loginPassword].forEach(input => {
      input.addEventListener("input", () => validateLoginField(input));
    });

    function validateLoginField(input) {
      loginErrorDiv.textContent = "";
      let valid = true;

      if (input.id === "loginEmail") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
          valid = false;
          loginErrorDiv.textContent = "Email i pavlefshëm.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      if (input.id === "passwordSignIn") {
        if (input.value.length < 6) {
          valid = false;
          loginErrorDiv.textContent = "Password duhet të ketë minimum 6 karaktere.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      return valid;
    }
  }

  // ======================
  // SIGNUP VALIDATION
  // ======================
  const signupForm = document.getElementById("SignUpForm");
  if (signupForm) {
    const signupFields = {
      firstName: document.getElementById("firstName"),
      lastName: document.getElementById("lastName"),
      emailSignUp: document.getElementById("emailSignUp"),
      passwordSignUp: document.getElementById("passwordSignUp"),
      confirmPasswordSignUp: document.getElementById("confirmPasswordSignUp")
    };
    const signUpErrorDiv = document.getElementById("loginError");

    signupForm.addEventListener("submit", () => {
      Object.values(signupFields).forEach(input => validateSignupField(input));
    });

    Object.values(signupFields).forEach(input => {
      input.addEventListener("input", () => validateSignupField(input));
    });

    function validateSignupField(input) {
      signUpErrorDiv.textContent = "";
      let valid = true;

      if (input.id === "firstName" || input.id === "lastName") {
        if (!/^[A-Za-z]{3,}$/.test(input.value)) {
          valid = false;
          signUpErrorDiv.textContent = "Emri dhe mbiemri duhet të kenë minimum 3 shkronja dhe pa numra.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      if (input.id === "emailSignUp") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
          valid = false;
          signUpErrorDiv.textContent = "Email i pavlefshëm.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      if (input.id === "passwordSignUp") {
        const passRegex = /^(?=.*[0-9])(?=.*[.!@#$%^&*]).{6,}$/;
        if (!passRegex.test(input.value)) {
          valid = false;
          signUpErrorDiv.textContent = "Password duhet të ketë minimum 6 karaktere, një numër dhe një simbol.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      if (input.id === "confirmPasswordSignUp") {
        if (input.value !== signupFields.passwordSignUp.value) {
          valid = false;
          signUpErrorDiv.textContent = "Password-et nuk përputhen.";
          input.classList.add("error");
        } else {
          input.classList.remove("error");
        }
      }

      return valid;
    }
  }
});


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
          errorP.textContent = "Name must contain at least 3 letters and no numbers.";
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
    let isValid = true;

    [nameInput, emailInput, messageInput].forEach((input) => {
        if (!validateContactField(input)) {
            isValid = false;
        }
    });

    if (!isValid) {
        e.preventDefault(); 
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