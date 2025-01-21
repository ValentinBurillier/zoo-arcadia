const formToCheck = [
    title = document.querySelector('#contact_title'),
    description = document.querySelector('#contact_description'),
    email = document.querySelector('#contact_mail'),
    message = document.querySelector('#contact_message'),

  ];
const form = document.querySelector('form');
const regMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(fr|com)/;
const regText = /^[a-zA-Z][a-zA-Z0-9-_ '.!?,]{0,500}$/;

formToCheck.forEach((e) => {
    e.addEventListener('input', () => {
        if(e.id === "contact_mail") {
            toCheck(e, regMail);
        } else {
            toCheck(e, regText);
        }
    })
})

function toCheck(textToCheck, regexToControl) {
    const result = regexToControl.test(textToCheck.value);
    if(result) {
        textToCheck.nextElementSibling.innerHTML = "";
    } else {
        if(textToCheck.id === "contact_mail") {
            textToCheck.nextElementSibling.innerHTML = "L'email doit être de forme '@example.com ou .fr'";
        } else {
            textToCheck.nextElementSibling.innerHTML = 'Autorisés : a-z, A-Z, 0-9, -, _, "espace"';
        }
    }
}

form.addEventListener('submit',(e) => {
    e.preventDefault();
    if(regMail.test(email.value) === true 
        && regText.test(title.value) === true 
        && regText.test(description.value) === true
        && regText.test(message.value) === true ) {
        form.submit();
    } else {
       alert('Le formulaire est incorrect, veuillez recommencer.');
    }
})  