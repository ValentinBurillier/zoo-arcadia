let stars = document.querySelectorAll('.star'); // recup all stars
let nbstars = stars.length;
console.log(nbstars);
stars.forEach((star, index) => { // 
  star.addEventListener('click', () => {
    for(let i = 0; i < index; i++) {
        stars[i].src= "/assets/images/gold_star.png";
    }
    stars[index].src = "/assets/images/gold_star.png";
    for(let dif = (index + 1); dif < nbstars; dif++) {
      stars[dif].src= "/assets/images/zoo-arcadia-white_star.webp";
    }
    })
  });