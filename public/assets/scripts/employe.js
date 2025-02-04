window.addEventListener('DOMContentLoaded', () => {
  // Récupère les tâches de l'employe
  const listEmployeTasks = document.querySelectorAll('#main .tasks');
  
  // Afficher en grand la liste sélectionnée lors du clique
  listEmployeTasks.forEach((task) => {
    task.addEventListener('click', (taskSelected) => {
      taskSelected = taskSelected.target.parentNode;
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
    })
  })
})