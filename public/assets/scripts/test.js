document.addEventListener("DOMContentLoaded", function () {
  const detailsElements = document.querySelectorAll("main > details");
  const main = document.querySelector("main");
  detailsElements.forEach((details) => {
      details.addEventListener("toggle", function () {
          if (details.open) {
            details.classList.add("actif");
            detailsElements.forEach((otherDetails) => {
              if (otherDetails !== details) {
                  otherDetails.open = false;
                  otherDetails.classList.remove("actif");
              }
          });
            main.prepend(details);
          }
      });
  });
});

const detailsHabitats = document.querySelectorAll("#alimentation > details");
const alimentation = document.querySelector('#alimentation');

detailsHabitats.forEach((habitat) => {
  habitat.addEventListener('toggle', () => {
    if(habitat.open) {
      detailsHabitats.forEach((otherHabitat) => {
        if(otherHabitat !== habitat) {
          otherHabitat.open = false;
        }
      });
      alimentation.prepend(habitat);
    }
  })
})