let display = false;
let body = document.querySelector('#body');
const menuMobil = document.querySelector('section#menuDisplay');
let removedMenuMobil;
let menuIcon = document.querySelector('.img__display');
let cross = document.querySelector('#menuDisplay img');
let header = document.querySelector('header');

menuIcon.addEventListener('click', () => {
  menuMobil.attributes.style.value = "";
  body.className = "menuActif";
})

cross.addEventListener('click', () => {
  menuMobil.attributes.style.value = "display: none";
  body.className = "";
})

window.addEventListener('resize', () => {
  let widthNow = window.innerWidth;
  if (widthNow > 999) {
    removedMenuMobil = menuMobil;
    menuMobil.remove();
  } else if (widthNow < 1000) {
    if (removedMenuMobil) {
      header.appendChild(removedMenuMobil);
    }
  }
})

window.addEventListener('DOMContentLoaded', function() {
  let widthNow = window.innerWidth;
  remove(menuMobil, widthNow);
});

function remove(menuMobil, widthNow) {
  if (widthNow > 999) {
    menuMobil.remove(); // Supprime le menu si la largeur est supérieure à 999
  }
}
