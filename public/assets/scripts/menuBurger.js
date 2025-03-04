// Affichage du menu lors du clique
const menuImg = document.querySelector('.iconMenu__header');
const menu = document.querySelector('.menu');
const crossCloseMenu = document.querySelector('.crossMenu');

menuImg.addEventListener('click', () => {
    console.log('click');
    menu.classList.toggle('hidden');
})

// Fermeture du menu lors du clique
crossCloseMenu.addEventListener('click', () => {
    menu.classList.toggle('hidden');
})
// // Redirection navigation
// const menuLinks = document.querySelectorAll('nav ul li a');
// menuLinks.forEach((link) => {
//     link.addEventListener('click', (y) => {
//         y.preventDefault();
//         try {
//             history.replaceState({document}, "", window.location.href);
        
//         } catch(error) {
//             console.error("Erreur lors de l'ajout de l'état à l'historique :", error);
//         }
//         const hrefUrl = link.getAttribute('href');
//         changePage(hrefUrl);
//     });
// });

// // Display habitats page
// const habitatsLink = document.querySelector('#fourthSection .linkBtn');
// habitatsLink.addEventListener('click', (event) => {
//     event.preventDefault();
//     console.log(habitatsLink);
//     try {
//         history.pushState({document}, "", window.location.href);
//     } catch(error) {
//         console.error("Erreur lors de l'ajout de l'état à l'historique :", error);
//     }
//     const hrefUrl = habitatsLink.getAttribute('href');
//     changePage(hrefUrl);
// })
// // Display reviews page
// const reviewsLink = document.querySelector('.test button a[href]');
// reviewsLink.addEventListener('click', (e) => {
//     history.pushState({document}, "", window.location.href);
//     // Desactivate link contact redirection
//     e.preventDefault();
//     const hrefLink = reviewsLink.getAttribute('href');
//     changePage(hrefLink);

// });

// function changePage(url) {
//     const xhr = new XMLHttpRequest();

//     xhr.open('GET', url, true);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             const response = xhr.responseText;

//             // Change title
//             const regexTitleElement = /<title>.+<\/title>/g;
//             const foundTitle = response.match(regexTitleElement);
//             const newTitle = foundTitle[0].split('title>')[1].split('</')[0];
//             document.title = newTitle;

//             // Change style css
//             const regexStyleElement = /<link rel="stylesheet".+">/g;
//             const foundStyle = response.match(regexStyleElement);
//             const newStyle = foundStyle[0].split('href=\"')[1].split("?")[0];
//             document.querySelector('link[type="text/css"]').href = newStyle;

//             // change body
//             const newBody = response.split('body">')[1].split('</body>')[0];
//             document.body.innerHTML = newBody;

//             history.pushState({}, "", url);
//         } else {
//             console.error('Error', xhr.status);
//         }
//     };

//     xhr.send();
// };
