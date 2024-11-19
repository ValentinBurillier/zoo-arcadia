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
console.log(listInputRoles);
let alertMsg = document.querySelector('.alert-success');
console.log(alertMsg);
alertMsg.addEventListener('click', () => {
  alertMsg.style.display = "none";
})

