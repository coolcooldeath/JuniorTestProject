const form = document.querySelector(".login form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");
loginError = form.querySelector("#login-error-text");
passwordError = form.querySelector("#password-error-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == '') {
                    location.reload();
                } else {
                    loginError.textContent = data.login;
                    loginError.style.visibility = "visible";
                    passwordError.textContent = data.password;
                    passwordError.style.visibility = "visible";

                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}