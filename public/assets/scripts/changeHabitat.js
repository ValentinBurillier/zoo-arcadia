let currentUrl = window.location.pathname;

let titles = document.querySelectorAll('section h2');
titles.forEach((e) => {
  e.addEventListener('click', () => {
    let newHabitat = e.innerText.toLowerCase();
    let currentHabitat = currentUrl.split("/")[2];
    let newUrl = currentUrl.replace(`/${currentHabitat}`, `/${newHabitat}`);
    window.location.href = newUrl;
  })
})

let listChange = document.querySelectorAll('main ul li');
listChange.forEach((e) => {
  e.addEventListener('click', () => {
    let fullClass = e.classList;
    fullClass.forEach((element) => {
      let truc = element.split("__");
      let newHabitat = truc[1].toLocaleLowerCase();
      let currentHabitat = currentUrl.split("/")[2];
      let newUrl = currentUrl.replace(`/${currentHabitat}`, `/${newHabitat}`);
      window.location.href = newUrl;
    })
  })
})
