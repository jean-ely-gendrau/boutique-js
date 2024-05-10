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
                console.log('Supprimer des favoris');
                pathClicked.setAttribute('style' ,'clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else if (result === 'Ajoute fav') {
                console.log('Ajoute des favoris');
                pathClicked.setAttribute('style' ,'clip-rule:evenodd;display:inline;fill:rgb(235, 55, 55);stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');
            } else {
                console.log('Connectez-vous')
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
// document.addEventListener('DOMContentLoaded', function () {
//     const headers = new Headers();
//     headers.append('Content-Type', 'application/json');
//     fetch('/jsConnected', {
//         headers: headers
//     }).then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     }).then(connected => {
//         isConnectedJS = connected;
//     }).catch(error => {
//         console.error('There was a problem with the fetch operation:', error);
//     });
// });
