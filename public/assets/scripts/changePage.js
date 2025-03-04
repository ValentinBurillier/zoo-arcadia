window.addEventListener('DOMContentLoaded',() => {
    // STEP 1 : Save Data Page Now
    const dataPageNow = saveDataPageNow();
    history.pushState(dataPageNow, "", '/');
    

    // STEP 2 : Start script
    start(dataPageNow);

    // STEP 6 : Event if back button is clicked and display old data on last page
    window.onpopstate = function(event) {
        console.log(event.state);
        if(event.state !== null) {
            document.title = event.state.title;
            document.body.innerHTML = event.state.body;
            document.querySelector('link[type="text/css"]').href = event.state.style;
            start(dataPageNow);
        }
    }
});

    function start(dataPageNow) {
        // STEP 3 : Detect click on link and desactivate redirection
        let links = document.querySelectorAll('a[href]');
        links.forEach((link) => {
            link.addEventListener('click',(e) => {
                e.preventDefault();
                const getHref = link.getAttribute('href');
                getDataNewPage(getHref);
            })
        })

        // STEP 4 : Get data new page
        function getDataNewPage(url) {
            const xhr = new XMLHttpRequest();

            xhr.open('GET', url, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    
                    // STEP 5 : Motify data for display new page
                    modifyData(response);
                    
                    // Modify URL
                    dataPageNow = saveDataPageNow();
                    history.pushState(dataPageNow, "", url);
                }
            }

            xhr.send();
        }

        // STEP 5 : Motify data for display new page
        function modifyData(data) {
            // Change title
            const regexTitleElement = /<title>.+<\/title>/g;
            const foundTitle = data.match(regexTitleElement);
            const newTitle = foundTitle[0].split('title>')[1].split('</')[0];
            document.title = newTitle;

            // Change style css
            const regexStyleElement = /<link rel="stylesheet".+">/g;
            const foundStyle = data.match(regexStyleElement);
            const newStyle = foundStyle[0].split('href=\"')[1].split("?")[0];
            document.querySelector('link[type="text/css"]').href = newStyle;


            // Change body
            const regexBodyElement = /<body.*>(\n|.)*<\/body>/g;
            const foundBody = data.match(regexBodyElement);
            const newBody = foundBody[0].split('id="body">')[1].split('</body>')[0];
            document.body.innerHTML = newBody;
            start();
        };
    }

function saveDataPageNow() {
    const getDataPageNow = {
        title: document.title,
        style: document.querySelector('link[type="text/css"]').href.split("?")[0],
        body: document.body.innerHTML
    }
    return getDataPageNow;
}