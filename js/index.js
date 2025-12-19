window.addEventListener("click", (e) => {
    if (e.target === SignUp) SignUp.style.display = "none";
    if (e.target === SignIn) SignIn.style.display = "none";
});

document.getElementById("menuToggle").onclick = function () {
    var nav = document.getElementById("mainNav");
    nav.classList.toggle("active");
};

document.addEventListener("DOMContentLoaded", () => {
    fetch("LogInForm.html")
        .then(res => res.text())
        .then(html => {
            document.body.insertAdjacentHTML("beforeend", html);
            const signUp = document.getElementById("SignUp");
            const signIn = document.getElementById("SignIn");

            document.querySelectorAll(".register-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    signUp.style.display = "flex";
                });
            });

            document.getElementById("toSignIn").onclick = (e) => {
                e.preventDefault();
                signUp.style.display = "none";
                signIn.style.display = "flex";
            };

            document.getElementById("toSignUp").onclick = (e) => {
                e.preventDefault();
                signIn.style.display = "none";
                signUp.style.display = "flex";
            };

            window.addEventListener("click", e => {
                if (e.target === signUp) signUp.style.display = "none";
                if (e.target === signIn) signIn.style.display = "none";
            });
        });
});

document.addEventListener("DOMContentLoaded", () => {
    const registerButtons = document.querySelectorAll(".register-btn");
    registerButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            
        });
    });
});
