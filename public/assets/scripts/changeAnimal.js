let currentUrl = window.location.pathname;
let listChange = document.querySelectorAll('main ul li');
listChange.forEach((e) => {
  e.addEventListener('click', () => {
    let fullClass = e.classList;
    fullClass.forEach((element) => {
      let truc = element.split("__");
      let newHabitat = truc[1].toLocaleLowerCase();
      let currentHabitat = currentUrl.split("/")[3];
      let newUrl = currentUrl.replace(`/${currentHabitat}`, `/${newHabitat}`);
      window.location.href = newUrl;
    })
  })
})