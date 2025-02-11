window.addEventListener('DOMContentLoaded', () => {
    if(window.innerWidth >= 744) {
        document.querySelector('.habitatClose').classList.toggle('habitatClose');
    }
    

    // Récupère les tâches du vétérinaire <li>
    const listVeterinaireTasks = document.querySelectorAll('#main .tasks h2');

    listVeterinaireTasks.forEach((task) => {
        task.addEventListener('click', () => {
          if (window.innerWidth <= 744) {
            const section = task.parentNode.querySelector('section');
            section.classList.toggle('habitatClose');
            section.parentNode.querySelector('h2').classList.toggle('listClose');
          }
        })
    })

        // Changer l'affichage sur ordinateur des tâches lors du clique
        const listTasksComputer = document.querySelectorAll('#header ul li');
        listTasksComputer.forEach((task) => {
          task.addEventListener('click', () => {
          const titleTwoTaskSelected = task.querySelector('h2');
          listVeterinaireTasks.forEach((e) => {
            let titleTwoMain = e.querySelector('h2');
            if(titleTwoMain.textContent === titleTwoTaskSelected.textContent) {
              titleTwoMain.nextElementSibling.classList.toggle('habitatClose');
            } else if(!titleTwoMain.nextElementSibling.classList.contains('habitatClose')) {
             titleTwoMain.nextElementSibling.classList.add('habitatClose');
            }
          })
        })
    })

    // Récupérer les données de chaque animal lors du clique
    const listAnimals = document.querySelectorAll('#main h3');
    listAnimals.forEach((animal) => {
        animal.addEventListener('click', () => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `veterinaire/${animal}`, true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
          
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log(response.message);
                    }
                }
            };

            xhr.send();
        })
    })
})