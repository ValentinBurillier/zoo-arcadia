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
const crossServices = document.querySelectorAll('.cross-container');
crossServices.forEach((e) => {
  e.addEventListener('click', () => {
    const id = e.getAttribute('data-id');
    deleteService(id);
  })
})

function deleteService(id) {
  if(!confirm(`Voulez-vous vraiment supprimer cet élément ? ${id}`)) {
    return;
  }

  fetch(`/admin/delete/${id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
    },
  })
  .then(response => {
    console.log(response);
    if(response.ok) {
      document.querySelector(`[data-id="${id}"]`).parentElement.parentElement.remove();
      alert('Supprimé avec succès');
    } else {
      alert('Erreur lors de la suppression');
    }
  })
  .catch(error => console.error('Erreur:', error));
}
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
      break;
    case "Services":
      item.parentElement.parentElement.style.display = 'block';
      let containerServices = item.nextElementSibling;
      let formServices = item.nextElementSibling.nextElementSibling;
      containerServices.style.display = 'flex';
      formServices.style.display = 'flex';
      formServices.parentElement.className = "secondItem";
      break;
    case "Habitats":
      item.parentElement.parentElement.style.display = 'block';
      let containerHabitats = item.nextElementSibling;
      let formHabitats = item.nextElementSibling.nextElementSibling;
      containerHabitats.style.display = 'flex';
      formHabitats.style.display = 'flex';
      formHabitats.parentElement.className = "secondItem";
      break;
    case "Animaux":
      item.nextElementSibling.style.display = "flex";
      document.querySelector('.animal-1').style.display = "flex";
      document.querySelector('.habitat-1').style.display = "flex";
      document.querySelector('.menu').className = "menu-animaux";
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

let alertMsg = document.querySelector('.alert-success');
console.log(alertMsg);
alertMsg.addEventListener('click', () => {
  alertMsg.style.display = "none";
})

