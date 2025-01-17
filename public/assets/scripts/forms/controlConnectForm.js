const formToCheck = [
    email = document.querySelector('#login_email'),
    password = document.querySelector('#login_password')
  ];
const regMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(fr|com)/;
const regPassword = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/;
  formToCheck.forEach((e) => {
    e.addEventListener('input', () => {
        switch(e.id) {
            case "login_email":
                toCheck(email.value, regMail);
                break;
            case "login_password":
                toCheck(password.value, regPassword);
                break;
            default:
                break;
        }
    })
})

function toCheck(textToCheck, regexToControl) {
    const result = regexToControl.test(textToCheck);
    console.log(result);
}