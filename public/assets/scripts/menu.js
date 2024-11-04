let display = false;
let body = document.querySelector('#body');
let menuMobil = document.querySelector('section#menuDisplay');
let menuIcon = document.querySelector('.img__display');
let cross = document.querySelector('#menuDisplay img');
menuIcon.addEventListener('click', () => {
  menuMobil.attributes.style.value = "";
  body.className = "menuActif";
})
cross.addEventListener('click', () => {
  menuMobil.attributes.style.value = "display: none";
  body.className = "";
})