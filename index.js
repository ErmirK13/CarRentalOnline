document.addEventListener("DOMContentLoaded", () => {

    fetch("LogInForm.html")
        .then(res => res.text())
        .then(html => {
            document.body.insertAdjacentHTML("beforeend", html);

            const signUp = document.getElementById("SignUp");
            const signIn = document.getElementById("SignIn");

            // hap SignUp
            document.querySelectorAll(".register-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    signUp.style.display = "flex";
                });
            });

            // kalim SignUp -> SignIn
            document.getElementById("toSignIn").addEventListener("click", e => {
                e.preventDefault();
                signUp.style.display = "none";
                signIn.style.display = "flex";
            });

            // kalim SignIn -> SignUp
            document.getElementById("toSignUp").addEventListener("click", e => {
                e.preventDefault();
                signIn.style.display = "none";
                signUp.style.display = "flex";
            });

            // mbyll modal kur klikon jashtë
            window.addEventListener("click", e => {
                if (e.target === signUp) signUp.style.display = "none";
                if (e.target === signIn) signIn.style.display = "none";
            });

            // VALIDIMI – Sign In
            document.getElementById("loginBtn").addEventListener("click", () => {
                let email = document.getElementById("loginEmail");
                let password = document.getElementById("loginPassword");

                let valid = validateSignInField(email) & validateSignInField(password);

                if (valid) {
                    alert("Login i suksesshëm ✅");
                    signIn.style.display = "none";
                }
            });

            ["loginEmail","loginPassword"].forEach(id=>{
                document.getElementById(id).addEventListener("input",(e)=>{
                    validateSignInField(e.target);
                });
            });

            // VALIDIMI – Sign Up
            document.getElementById("registerBtn").addEventListener("click", () => {
                const ids = ["firstName","lastName","emailSignUp","passwordSignUp","confirmPasswordSignUp"];
                let valid = true;
                ids.forEach(id => {
                    if (!validateSignUpField(document.getElementById(id))) valid = false;
                });

                if (valid) {
                    alert("Regjistrimi u krye me sukses ✅");
                    signUp.style.display = "none";
                    signIn.style.display = "flex";
                }
            });

            ["firstName","lastName","emailSignUp","passwordSignUp","confirmPasswordSignUp"].forEach(id=>{
                document.getElementById(id).addEventListener("input",(e)=>{
                    validateSignUpField(e.target);
                });
            });

        });
});

// =======================
// FUNKSIONET VALIDIM
// =======================

function validateSignInField(input) {
    const error = document.getElementById("loginError");
    error.textContent = "";

    let valid = true;

    if (input.id === "loginEmail") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
            input.classList.add("error");
            input.classList.remove("valid");
            valid = false;
            error.textContent = "Email-i nuk është valid.";
        } else {
            input.classList.remove("error");
            input.classList.add("valid");
        }
    }

    if (input.id === "loginPassword") {
        if (input.value.length < 6) {
            input.classList.add("error");
            input.classList.remove("valid");
            valid = false;
            error.textContent = "Password duhet të ketë të paktën 6 karaktere.";
        } else {
            input.classList.remove("error");
            input.classList.add("valid");
        }
    }

    return valid;
}

function validateSignUpField(input) {
    const error = document.getElementById("registerError");
    error.textContent = "";

    let valid = true;

    if (input.id === "firstName" || input.id === "lastName") {
        if (!/^[A-Za-z]{3,}$/.test(input.value)) {
            input.classList.add("error");
            input.classList.remove("valid");
            valid = false;
            error.textContent = "Emri dhe mbiemri duhet të kenë të paktën 3 shkronja dhe pa numra.";
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
            error.textContent = "Email-i nuk është valid.";
        } else {
            input.classList.remove("error");
            input.classList.add("valid");
        }
    }

   if (input.id === "passwordSignUp") {
    // RegEx: minimum 6 karaktere, të paktën një numër dhe një simbol
    const passRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*(),.?":{}|<>]).{6,}$/;
    if (!passRegex.test(input.value)) {
        input.classList.add("error");
        input.classList.remove("valid");
        valid = false;
        error.textContent = "Password duhet të ketë minimum 6 karaktere, të paktën një numër dhe një simbol.";
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
            error.textContent = "Password-at nuk përputhen.";
        } else {
            input.classList.remove("error");
            input.classList.add("valid");
        }
    }

    return valid;
}
// Validim për contact form
document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.querySelector(".contact-form");
    const nameInput = document.getElementById("Name");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");

    // Shto p-element për gabimet
    let errorP = document.createElement("p");
    errorP.id = "contactError";
    contactForm.appendChild(errorP);

    function validateContactField(input) {
        let valid = true;
        errorP.textContent = "";

        if (input.id === "Name") {
            if (!/^[A-Za-z\s]{3,}$/.test(input.value)) {
                input.classList.add("error");
                input.classList.remove("valid");
                valid = false;
                errorP.textContent = "Emri duhet të ketë të paktën 3 shkronja dhe pa numra.";
            } else {
                input.classList.remove("error");
                input.classList.add("valid");
            }
        }

        if (input.id === "email") {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.classList.add("error");
                input.classList.remove("valid");
                valid = false;
                errorP.textContent = "Email-i nuk është valid.";
            } else {
                input.classList.remove("error");
                input.classList.add("valid");
            }
        }

        if (input.id === "message") {
            if (input.value.length < 10) {
                input.classList.add("error");
                input.classList.remove("valid");
                valid = false;
                errorP.textContent = "Mesazhi duhet të ketë të paktën 10 karaktere.";
            } else {
                input.classList.remove("error");
                input.classList.add("valid");
            }
        }

        return valid;
    }

    [nameInput,emailInput,messageInput].forEach(input => {
        input.addEventListener("input", e => validateContactField(e.target));
    });

    contactForm.addEventListener("submit", e => {
        e.preventDefault();
        let valid = true;
        [nameInput,emailInput,messageInput].forEach(input => {
            if(!validateContactField(input)) valid = false;
        });

        if(valid){
            alert("Mesazhi u dërgua me sukses ✅");
            contactForm.reset();
            [nameInput,emailInput,messageInput].forEach(input => input.classList.remove("valid"));
        }
    });
});
