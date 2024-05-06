const body = document.body;
let currentWishlist = [];
let isConnectedJS = false;

body.addEventListener('click', function (event) {
    if (isConnectedJS !== false) {
        if (event.target.classList.contains('favorites')) {

        }
    } else {
        console.log('Connect to add');
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
