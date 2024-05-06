const body = document.body;
let currentWishlist = [];

body.addEventListener('click', function (event) {
    
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
            }).then(connected => {
                isConnectedJS = connected;
                console.log(isConnectedJS);
            }).catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }
    
});

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
