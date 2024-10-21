let titleAnimal = document.querySelector('section > h2');
let dataAnimal = document.querySelector('#cardAnimal');
let cross = document.querySelector('#cross');
let view = false;
titleAnimal.addEventListener('click', () => {
  if (view === false) {
    dataAnimal.style.display = 'flex';
    view = true;
  } else if (view === true) {
    dataAnimal.style.display = 'none';
    view = false;
  }
})
cross.addEventListener('click', () => {
  if (view === true && dataAnimal.style.display === 'flex') {
    dataAnimal.style.display = 'none';
    view = false;
  }
})