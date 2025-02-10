window.addEventListener('DOMContentLoaded', () => {
  // Récupère les tâches de l'employe <li>
  const listEmployeTasks = document.querySelectorAll('#main .tasks');
  
  // Afficher en grand la liste sélectionnée lors du clique
  listEmployeTasks.forEach((task) => {
    if (window.screen.width <= 744) {
    task.addEventListener('click', (taskSelected) => {
      if(taskSelected.target.parentNode.classList.length === 1) {
        taskSelected = taskSelected.target.parentNode;
        openTask(listEmployeTasks, taskSelected);
      } else if (taskSelected.target.parentNode.classList.length === 2) {
        taskSelected.target.parentNode.classList.remove("taskSelected");
        taskSelected.target.parentNode.parentNode.classList.remove("taskSelectedContainer");
        console.log(taskSelected.target.parentNode.classList[1]);
        taskSelected.target.parentNode.querySelector('section').style.display = "none";
        const listsHidden = taskSelected.target.parentNode.parentNode.querySelectorAll('.tasks[style.display === "none"]');
      }
    })
  }})
})

function detectIfClassIsSelected(taskToDeselect, task) {
  if(taskToDeselect.classList.length > 0) {
    while(taskToDeselect.classList.length > 0) {
      taskToDeselect.classList.remove(taskToDeselect.classList[0]);
    }
  }
}

function openTask(listEmployeTasks, taskSelected) {
  listEmployeTasks.forEach((e) => {
    if(e === taskSelected) {
      taskSelected.classList.add('taskSelected');
      taskSelected.querySelector('section').style.display = "initial";
      taskSelected.parentNode.classList.add('taskSelectedContainer');
      const containerReviews = taskSelected.querySelectorAll('.hidden');
      containerReviews.forEach((review) => {
      review.classList.remove('hidden');
      })
    } else {
      e.classList.remove('taskSelected');
    }
  })
}


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
          }
      }
  };

  xhr.send();
}

// Supprimer le display none de la section ReviewsToCheck
window.addEventListener('resize', () => {
  const sectionReviewsToCheck = document.querySelector('#reviewsToCheck section');
  if(window.innerWidth >= 744) {
    sectionReviewsToCheck.style.display = "initial";
  }
})