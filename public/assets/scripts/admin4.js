const menuList = document.querySelectorAll('.menu li h2');
menuList.forEach((e) => {
  e.addEventListener('click', () => {
    menuList.forEach((y) => {
      if (e !== y) {
        y.style.display = "none";
      } else {
        y.style.display = "initial";
        selected(e);
      }
    })
  })
})

function selected(item) {
  switch (item.innerText) {
    case "Créer un compte":
      let form = item.nextElementSibling;
      form.style.display = 'flex';
      form.parentElement.className = "firstItem";
      break;
    case "Horaires":
      let formHours = item.nextElementSibling;
      formHours.style.display = 'flex';
      formHours.parentElement.className = "thirdItem";
    case "Services":
      let containerServices = item.nextElementSibling;
      let formServices = item.nextElementSibling.nextElementSibling;
      containerServices.style.display = 'flex';
      formServices.style.display = 'flex';
      formServices.parentElement.className = "secondItem";
    default:
      break;
  }
}
let listInputRoles = document.querySelectorAll('.radio-wrapper input');
listInputRoles.forEach((e) => {
  e.addEventListener('click', () => {
    listInputRoles.forEach((otherRole) => {
      if(otherRole !== e) {
        otherRole.checked = false;
      }
    })
  })
})

let alertMsg = document.querySelector('.alert-success');
console.log(alertMsg);
alertMsg.addEventListener('click', () => {
  alertMsg.style.display = "none";
})

