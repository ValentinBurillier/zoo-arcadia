let currentUrl = window.location.pathname;

let titles = document.querySelectorAll('section h2');
titles.forEach((e) => {
  e.addEventListener('click', () => {
    let newHabitat = e.innerText;
    let currentHabitat = currentUrl.split("/")[2];
    let newUrl = currentUrl.replace(`/${currentHabitat}`, `/${newHabitat}`);
    window.location.href = newUrl;
  })
})