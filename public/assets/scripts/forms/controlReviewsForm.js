// Control Reviews Page via regex
const elementsFormToCheck = [
    pseudo = document.querySelector('#reviews_pseudo'),
    comment = document.querySelector('#reviews_comment')
  ];
  const regForm = /^[a-zA-Z][a-zA-Z0-9-_ ']{0,50}$/;
  const regCommentForm = /^[a-zA-Z][a-zA-Z0-9-_ ']{0,500}$/;
  elementsFormToCheck.forEach((e) => {
    e.addEventListener('input', () => {
      toCheck(e, regForm);
      if(e.tagName === 'INPUT') {
        controlLength(e);
      }
    })
  })
  
  function toCheck(textToCheck, regexToControl) {
    let valueElement = textToCheck.value;
    let result = regexToControl.test(valueElement);
    
    if(result === false) {
      switch(textToCheck.tagName) {
        case "INPUT":
          const errorForm = document.querySelector('#errorForm');
          errorForm.innerHTML = 'Autorisés : a-z, A-Z, 0-9, -, _, "espace"';
          break;
        case "TEXTAREA":
          const errorFormComment = document.querySelector('#errorFormComment');
          errorFormComment.innerHTML = 'Autorisés : a-z, A-Z, 0-9, -, _, "espace"';
          break;
        default:
          break;
      }
    } else {
      switch(textToCheck.tagName) {
        case "INPUT":
          const errorForm = document.querySelector('#errorForm');
          errorForm.innerHTML = "";
          break;
        case "TEXTAREA":
          const errorFormComment = document.querySelector('#errorFormComment');
          errorFormComment.innerHTML = "";
          break;
        default:
          break;
    }
  }
  }

  function controlLength(pseudoToControl) {
   if(pseudoToControl.value.length > 50) {
    errorForm.innerHTML = "Maximum 50 caractères";
   }
  }
 
  // CONTROL FORM BEFORE SUBMISSION
  const form = document.querySelector('form');
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    checkBeforeSubmit();
  })
  function checkBeforeSubmit() {
    let resPseudo = regForm.test(document.querySelector('#reviews_pseudo').value);
    let resComment = regCommentForm.test(document.querySelector('#reviews_comment').value);
    let allStars = document.querySelectorAll('label img');
    let arrayGoldStar = [];
    allStars.forEach((star) => {
        let srcStar = star.src;
        let item = "gold_star";
        if(srcStar.includes(item)) {
            arrayGoldStar.push(srcStar);
        }
        
    })
        if(arrayGoldStar.length > 0 && arrayGoldStar.length < 6) {
            if((resPseudo && resComment) === true) {
                form.submit();
            }
    } else {
      const msgStars = document.querySelector('#msgStars');
      msgStars.innerHTML = "Indiquez une note";
    }
  }