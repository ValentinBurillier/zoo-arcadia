// Affichage du menu lors du clique
const menuImg = document.querySelector('.iconMenu__header');
const menu = document.querySelector('.menu');
const crossCloseMenu = document.querySelector('.crossMenu');

menuImg.addEventListener('click', () => {
    console.log('click');
    menu.classList.toggle('hidden');
})

// Fermeture du menu lors du clique
crossCloseMenu.addEventListener('click', () => {
    menu.classList.toggle('hidden');
})