// document.getElementById("menuToggle").onclick = function () {
//   var nav = document.getElementById("mainNav");
//   nav.classList.toggle("active");
// };

// pjesa e sign in edhe sign up
// const SignUp = document.getElementById("SignUp");
// const SignIn = document.getElementById("SignIn");


// document.querySelector(".register-btn").addEventListener("click", () => {
//     SignUp.style.display = "flex";
// });


// document.getElementById("SignInform").addEventListener("click", () => {
//     SignUp.style.display = "none";
//     SignIn.style.display = "flex";
// });

// document.getElementById("SignUpform").addEventListener("click", () => {
//     SignIn.style.display = "none";
//     SignUp.style.display = "flex";
// });

window.addEventListener("click", (e) => {
    if (e.target === SignUp) SignUp.style.display = "none";
    if (e.target === SignIn) SignIn.style.display = "none";
});

// const menuToggle = document.getElementById("menuToggle");
// const mainNav = document.getElementById("mainNav");

// menuToggle.addEventListener("click", () => {
//     mainNav.classList.toggle("show");
// });

document.getElementById("menuToggle").onclick = function () {
  var nav = document.getElementById("mainNav");
  nav.classList.toggle("active");
};




const signIn = document.getElementById("SignIn");
const signUp = document.getElementById("SignUp");

const toSignUp = document.getElementById("toSignUp");
const toSignIn = document.getElementById("toSignIn");

// 👉 KUR FAQJA HAPET: SHFAQ SIGN IN
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

//pjesa e services

let total = 0;
const cartList = document.getElementById("cartList");
const totalPrice = document.getElementById("totalPrice");

function addToCart(name, price) {
  const li = document.createElement("li");
  li.textContent = `${name} - €${price}`;
  cartList.appendChild(li);
  total += price;
  totalPrice.textContent = total;
}
