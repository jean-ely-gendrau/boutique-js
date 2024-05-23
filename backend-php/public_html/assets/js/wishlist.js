const body = document.body;
const favProducts = document.querySelectorAll('.favorites');

// function favProductsCheck() {
favProducts.forEach(element => {
    if (element.classList.contains('inFav')) {
        let change = element.querySelector('path');
        change.setAttribute('style', 'clip-rule:evenodd;display:inline;fill:rgb(235, 55, 55);stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
    }
});
// }

function checkVerify(event) {
    const isFavoriteClicked = event.target.closest('.favorites');
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
                messageFav('Supprimé des favoris');
                pathClicked.setAttribute('style', 'clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else if (result === 'Ajoute fav') {
                messageFav('Ajouté aux favoris');
                pathClicked.setAttribute('style', 'clip-rule:evenodd;display:inline;fill:rgb(235, 55, 55);stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else if (result === 'Connect to use') {
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
            if (result === 'Suppre done') {
                messageFav('Supprimé des favoris');
            } else if (result === 'Ajoute fav') {
                messageFav('Ajouté aux favoris');
            } else if (result === 'Connect to use') {
                messageFav('Connectez-vous pour ajouter à vos favoris !');
            }
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
}

// Utilisation de la fonction messageFav afin d'afficher la validation du produit sélectionné par le client
function addToBasket(event) {
    const addToCartButtons = event.target.closest('.add-to-cart');
    if(addToCartButtons) messageFav('Ajouté au panier');
}

let messageDiv; 
let messageTimer; 

function messageFav(text) {
    if (messageDiv) {
        messageDiv.remove(); 
        clearTimeout(messageTimer);
    }

    messageDiv = document.createElement('div');
    messageDiv.classList.add('fixed', 'bottom-0', 'right-0');

    const message = document.createElement('div');
    message.textContent = text;
    message.classList.add('p-4', 'bg-gray-300', 'text-black', 'rounded-lg');

    
    message.style.marginBottom = '2rem';
    message.style.marginRight = '2rem';

    messageDiv.appendChild(message);
    document.body.appendChild(messageDiv);

    messageTimer = setTimeout(function () {
        messageDiv.remove();
        messageDiv = null;
        messageTimer = null;
    }, 2000);
}

body.addEventListener('click', addToBasket);
body.addEventListener('click', checkVerify);
body.addEventListener('click', addToFavorite);
// document.addEventListener('DOMContentLoaded', favProductsCheck);