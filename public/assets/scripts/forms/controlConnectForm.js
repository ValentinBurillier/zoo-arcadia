const formToCheck = [
    email = document.querySelector('#login_email'),
    password = document.querySelector('#login_password'),
    form = document.querySelector('form')
  ];
const regMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(fr|com)/;
const regPassword = /^.{8,64}/;
  formToCheck.forEach((e) => {
    e.addEventListener('input', () => {
        switch(e.id) {
            case "login_email":
                toCheck(email, regMail);
                break;
            case "login_password":
                toCheck(password, regPassword);
                break;
            default:
                break;
        }
    })
})

function toCheck(textToCheck, regexToControl) {
    const result = regexToControl.test(textToCheck.value);
    if(result===false) {
        switch(textToCheck.id) {
            case "login_email":
                document.querySelector('#emailError').innerHTML = "L'email doit être de forme '@example.com ou .fr'";
                break;
            case "login_password":
                document.querySelector('#passwordError').innerHTML = "Mot de passe entre 8 et 64 caractères";
                break;
            default:
                break;
        }
    } else {
        document.querySelector('#emailError').innerHTML = "";
        document.querySelector('#passwordError').innerHTML = "";
    }
}

form.addEventListener('submit',(e) => {
    e.preventDefault();
    if(regMail.test(email.value) === true && regPassword.test(password.value) === true) {
        form.submit();
    } else {
        document.querySelector('#emailError').innerHTML = "L'email doit être de forme '@example.com ou .fr'";
        document.querySelector('#passwordError').innerHTML = "Mot de passe entre 8 et 64 caractères";
    }
})

document.querySelector('#errorMsg').addEventListener('click', () => {
    document.querySelector('#errorMsg').style.display = "none";
})