window.addEventListener('DOMContentLoaded', () => {
    
    const tasksTitles = document.querySelectorAll('.taskAdmin h2');
    tasksTitles.forEach((taskTitle) => {
        taskTitle.addEventListener('click', (titleSelected) => {
            if(window.innerWidth < 744) {
                tasksTitles.forEach((e) => {
                    if(e === titleSelected.target) {
                        console.log(e);
                        e.nextElementSibling.classList.toggle('hidden');
                    } else {
                        e.parentNode.classList.toggle('hidden');
                    }
                })
            }
        })
    })
});

window.addEventListener('DOMContentLoaded', () => {
    const habitatContainers = document.querySelectorAll('.habitat-container');

    habitatContainers.forEach((container) => {
        const habitatIndex = container.getAttribute('data-index');
        const habitatDetails = document.getElementById(`habitat-details-${habitatIndex}`);

        // Afficher le premier habitat par défaut
        if (habitatIndex === "1") {
            habitatDetails.classList.remove('hidden');
        }

        container.addEventListener('click', () => {
            // Masquer tous les autres détails
            document.querySelectorAll('.habitat-details').forEach((details) => {
                details.classList.add('hidden');
            });

            // Afficher les détails de l'habitat sélectionné
            habitatDetails.classList.remove('hidden');
        });
    });
});
