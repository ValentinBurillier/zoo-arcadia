document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('button');
    const detailsContent = document.getElementById('details-content');
    const sectionHabitats = document.querySelectorAll('.img--habitat');
    const iconMenu = document.querySelector('.iconMenu__header');
  
    buttons.forEach((button) => {
        button.addEventListener('click', () => {
           const habitatSelected = button.parentNode;
           sectionHabitats.forEach((e) => {
            if(e !== habitatSelected) {
             e.remove();
            } else {
                habitatSelected.setAttribute('data-habitat', 'selected');
                const description = document.querySelector('p');
                description.style.display = "initial";
                changeIconmenu(habitatSelected, iconMenu);
            }
           })
        })
    })
})

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