const menuList = document.querySelectorAll('.menu li h2');
console.log(menuList);
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