// JavaScript for toggle menu
document.getElementById("menuToggle").onclick = function () {
  var nav = document.getElementById("mainNav");
  nav.classList.toggle("active");
};

// JavaScript for Sign In / Sign Up toggle
const signIn = document.getElementById("SignIn");
const signUp = document.getElementById("SignUp");

const toSignUp = document.getElementById("toSignUp");
const toSignIn = document.getElementById("toSignIn");

// initial state
signIn.style.display = "flex";

// switch to Sign Up
toSignUp.addEventListener("click", (e) => {
  e.preventDefault();
  signIn.style.display = "none";
  signUp.style.display = "flex";
});

// switch to Sign In
toSignIn.addEventListener("click", (e) => {
  e.preventDefault();
  signUp.style.display = "none";
  signIn.style.display = "flex";
});

// JavaScript for viewing car details
function viewCarDetails(name, price, type, transmission, imgSrc) {
  //
  const car = { name, price, type, transmission, imgSrc };
  localStorage.setItem("selectedCar", JSON.stringify(car));

  // Redirect to car details page
  window.location.href = "car-details.html";
}
