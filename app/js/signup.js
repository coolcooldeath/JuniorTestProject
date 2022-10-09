const form = document.querySelector(".signup form"),
    continueBtn = form.querySelector(".button input"),
    loginErrorText = form.querySelector("#login-error-text");
emailErrorText = form.querySelector("#email-error-text");
nameErrorText = form.querySelector("#name-error-text");
passwordErrorText = form.querySelector("#password-error-text");
passwordRepeatErrorText = form.querySelector("#password-repeat-error-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {

                let data = xhr.response;


                if (data == '') {
                    location.reload();
                } else {
                    loginErrorText.textContent = data.login;
                    loginErrorText.style.visibility = "visible";
                    emailErrorText.textContent = data.email;
                    emailErrorText.style.visibility = "visible";
                    nameErrorText.textContent = data.name;
                    nameErrorText.style.visibility = "visible";
                    passwordErrorText.textContent = data.password;
                    passwordErrorText.style.visibility = "visible";
                    passwordRepeatErrorText.textContent = data.password_repeat;
                    passwordRepeatErrorText.style.visibility = "visible";
                }


            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}