window.addEventListener('DOMContentLoaded', () => {
  if(window.innerWidth >= 744) {
    document.querySelector('.habitatClose').classList.toggle('habitatClose');
  }

  // Récupère les tâches de l'employe <li>
  const listEmployeTasks = document.querySelectorAll('#main .tasks');
  
    listEmployeTasks.forEach((task) => {
      task.addEventListener('click', () => {
        if (window.innerWidth <= 744) {
          const section = task.querySelector('section');
          section.classList.toggle('taskClose');
          section.parentNode.querySelector('h2').classList.toggle('listClose');
        }
      })
    })

    // Changer l'affichage sur ordinateur des tâches lors du clique
    const listTasksComputer = document.querySelectorAll('#header ul li');
    listTasksComputer.forEach((task) => {
      task.addEventListener('click', () => {
      const titleTwoTaskSelected = task.querySelector('h2');
      listEmployeTasks.forEach((e) => {
        let titleTwoMain = e.querySelector('h2');
        if(titleTwoMain.textContent === titleTwoTaskSelected.textContent) {
          titleTwoMain.nextElementSibling.classList.toggle('taskClose');
        } else if(!titleTwoMain.nextElementSibling.classList.contains('taskClose')) {
         titleTwoMain.nextElementSibling.classList.add('taskClose');
        }
      })
      })
    })
  })


// Autoriser ou supprimer un avis en fonction du clique sur le bouton
const allBtnValidReviews = document.querySelectorAll('.valid_review');
const allBtnDeleteReviews = document.querySelectorAll('.delete_review');

allBtnValidReviews.forEach((validReview) => {
  validReview.addEventListener('click', () => {
    submitReview(validReview);
  })
})

allBtnDeleteReviews.forEach((deleteReview) => {
  deleteReview.addEventListener('click', () => {
    submitReview(deleteReview);
  })
})

function submitReview(btnChoice) {
  const choiceReview = btnChoice.getAttribute('class');
  switch (choiceReview) {
    case 'valid_review':
      confirmReview("valider", btnChoice);
      break;
    case 'delete_review':
      confirmReview("supprimer", btnChoice);
      break;
    default:
      break;
  }
}

function confirmReview(choice, btnChoice) {
  const reviewId = btnChoice.parentNode.parentNode.getAttribute('data-id');
  let xhr = new XMLHttpRequest();
  xhr.open('POST', `avis/${choice}/${reviewId}`, true);
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          let response = JSON.parse(xhr.responseText);
          if (response.success) {
              alert(response.message);
              location.reload();
          }
      }
  };

  xhr.send();
}