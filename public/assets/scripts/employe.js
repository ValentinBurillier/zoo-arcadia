window.addEventListener('DOMContentLoaded', () => {
  // Récupère les tâches de l'employe <li>
  const listEmployeTasks = document.querySelectorAll('#main .tasks');
  
  // Afficher en grand la liste sélectionnée lors du clique
  listEmployeTasks.forEach((task) => {
    task.addEventListener('click', (taskSelected) => {
      if(taskSelected.target.parentNode.classList.length === 1) {
        console.log(1);
        taskSelected = taskSelected.target.parentNode;
        openTask(listEmployeTasks, taskSelected);
      } else if (taskSelected.target.parentNode.classList.length === 2) {
        taskSelected.target.parentNode.classList.remove("taskSelected");
        taskSelected.target.parentNode.parentNode.classList.remove("taskSelectedContainer");
        console.log(taskSelected.target.parentNode.classList[1]);
        taskSelected.target.parentNode.querySelector('section').style.display = "none";
        const listsHidden = taskSelected.target.parentNode.parentNode.querySelectorAll('.tasks[style.display === "none"]');
        listsHidden.forEach((list) => {
          console.log(list);
          list.style.display = "";
        })
        console.log(task);
      }
    })
  })
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
      taskSelected.parentNode.classList.add('taskSelectedContainer');
      const containerReviews = taskSelected.querySelectorAll('.hidden');
      containerReviews.forEach((review) => {
      review.classList.remove('hidden');
      })
    } else {
      e.classList.remove('taskSelected');
      e.style.display = 'none';
    }
  })
}