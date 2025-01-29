
const sections = document.querySelectorAll('section');
const list = document.querySelector('#changeAnimalsBtn');
const childrens = list.querySelectorAll('li');

// Mettre à la première puce en jaune
list.firstElementChild.style.backgroundColor = '#FFD771';

// Evenement sur un click du bouton and change animal
childrens.forEach((item) => {
    item.addEventListener('click', (e) => {
        const idBtn = e.target.getAttribute('data-li');
        childrens.forEach((child) => {
            if(child === e.target) {
                child.style.backgroundColor = '#FFD771';
            } else {
                child.style.backgroundColor = '';
            }
        })
        sections.forEach((section) => {
            if(idBtn === section.getAttribute('data-id')) {
                section.style.display = "flex";
            } else {
                section.style.display = "none";
            }
        })
    })
})

  // Fonction pour vérifier la largeur de l'écran et supprimer le style inline
  function removeDisplayStyleOnResize(minWidth) {

    // Vérifie si la largeur de l'écran est supérieure ou égale à minWidth
    if (window.innerWidth >= minWidth) {
        sections.forEach((element) => {
        element.style.removeProperty('display'); // Supprime le style inline "display"
      });
    }
  }

  // Exécution au chargement de la page
  removeDisplayStyleOnResize(744);

  // Ajout d'un EventListener pour surveiller les redimensionnements de l'écran
  window.addEventListener('resize', () => {
    removeDisplayStyleOnResize(768); // 768px est la largeur minimale
  });

  const titles2 = document.querySelectorAll('h2');
  titles2.forEach((title) => {
    title.addEventListener('click', () => {
        // Supprimer le style "display: none" dans la balise
        const parent = title.parentNode;
        const dataAnimal = parent.querySelector('div');
        console.dir(dataAnimal);
        dataAnimal.removeAttribute('style');
        detectCloseInfoWindow(parent);
    })
  })

  function detectCloseInfoWindow(parent) {
    const closeBtn = parent.querySelector('img');
    closeBtn.addEventListener('click', () => {
        closeBtn.parentNode.style.display = 'none';
    })
  }

// Fonction pour changer les données des animaux en fonction de la section cliquée