document.addEventListener('DOMContentLoaded', () => {
    let buttons = document.querySelectorAll('button');
    const detailsContent = document.getElementById('details-content');
    const sectionHabitats = document.querySelectorAll('.img--habitat');
    const iconMenu = document.querySelector('.iconMenu__header');

    // Display Description Habitat On Click And Remove Others
    buttons.forEach((button) => {
        button.addEventListener('click', (btnElement) => {
           const habitatSelected = button.parentNode;
           sectionHabitats.forEach((e) => {
            if(e !== habitatSelected) {
             e.remove();
            } else {
                habitatSelected.setAttribute('data-habitat', 'selected');
                const description = document.querySelector('p');
                description.style.display = "initial";
                btnElement.target.classList.add('displayAnimals');
                changeIconmenu(habitatSelected, iconMenu);
                detectForDisplayAnimals();
                buttons = null;
                button = null;
            }
           })
        })
    })
})
function detectForDisplayAnimals() {
    const btnForDisplayAnimals = document.querySelector('.displayAnimals');
    btnForDisplayAnimals.addEventListener('click', () => {
        const title2 = document.querySelector('h2');
        const habitatName = title2.innerText.toLowerCase();
        const url = `/habitats/${habitatName}`;

        fetch(url)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
    })
    
}

function changeIconmenu(habitatSelected, iconMenu) {
    const habitatName = habitatSelected.firstChild.nextElementSibling.innerText.toLowerCase();
    switch(habitatName) {
        case "jungle":
            iconMenu.src = "/assets/images/zoo-arcadia-green_menu.webp";
            break;
        case "marais":
            iconMenu.src = "/assets/images/zoo-arcadia-marais-menu.webp";
            break;
        case "savane":
            iconMenu.src = "/assets/images/zoo-arcadia-brown_menu.webp";
            break;
        default:
            break;
    }
}