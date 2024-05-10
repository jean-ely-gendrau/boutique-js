const body = document.body;
const favProducts = document.querySelectorAll('.favorites');


favProducts.forEach(element => {
    let idFav = parseInt(element.id);
    // console.log(idFav);
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    fetch(`/favoris/${idFav}`, {
        headers: headers
    }).then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }).then(result => {
        if (result === true) {
            // console.log(element);
            let aaaa = element.querySelector('path');
            aaaa.setAttribute('style', 'clip-rule:evenodd;display:inline;fill:rgb(235, 55, 55);stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1')
        }
    }).catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});

body.addEventListener('click', checkVerify);
function checkVerify(event) {
    const isFavoriteClicked = event.target.closest('.favorites');
    // console.log(isFavoriteClicked);
    if (isFavoriteClicked) {
        let idFav = parseInt(isFavoriteClicked.getAttribute('id'));
        let pathClicked = isFavoriteClicked.querySelector('path');
        const headers = new Headers();
        headers.append('Content-Type', 'application/json');
        fetch(`/addFavoris/${idFav}`, {
            headers: headers
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(result => {
            if (result === 'Suppre done') {
                console.log('Ajouté aux favoris');
                pathClicked.setAttribute('style' ,'clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else if (result === 'Ajoute fav') {
                messageFav('Ajoute aux favoris')
                pathClicked.setAttribute('style' ,'clip-rule:evenodd;display:inline;fill:rgb(235, 55, 55);stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else if (result === 'Connect to use'){
                messageFav('Connectez-vous pour ajouter à vos favoris !');
            }
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
}

function addToFavorite(event) {
    if (event.target.classList.contains('favorites')) {
        let idFav = parseInt(event.target.getAttribute('id'));
        const headers = new Headers();
        headers.append('Content-Type', 'application/json');
        fetch(`/favoris/${idFav}`, {
            headers: headers
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(result => {
            console.log(result);
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
}

function messageFav(text) {
    const message = document.createElement('div');
    message.textContent = text;
    message.classList.add('fixed', 'bottom-0', 'right-0', 'p-4', 'bg-gray-300', 'text-black', 'rounded-lg');

    document.body.appendChild(message);

    setTimeout(function() {
        message.remove();
    }, 3000); 
}
