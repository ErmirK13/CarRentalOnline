document.getElementById("menuToggle").onclick = function () {
  var nav = document.getElementById("mainNav");
  nav.classList.toggle("active");
};
const SignUp = document.getElementById("SignUp");
const SignIn = document.getElementById("SignIn");


document.querySelector(".register-btn").addEventListener("click", () => {
    SignUp.style.display = "flex";
});


document.getElementById("toSignIn").addEventListener("click", () => {
    SignUp.style.display = "none";
    SignIn.style.display = "flex";
});


document.getElementById("toSignUp").addEventListener("click", () => {
    SignIn.style.display = "none";
    SignUp.style.display = "flex";
});


window.addEventListener("click", (e) => {
    if (e.target === SignUp) SignUp.style.display = "none";
    if (e.target === SignIn) SignIn.style.display = "none";
});