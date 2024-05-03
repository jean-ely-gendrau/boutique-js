
const body = document.body;
let currentWishlist = []

body.addEventListener('click', function(event) {
    if (event.target.classList.contains('favorites')) {

        console.log(event.target.getAttribute('id'));
        currentWishlist += event.target.getAttribute('id');
        console.log(currentWishlist);
    }
});