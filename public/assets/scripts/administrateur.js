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