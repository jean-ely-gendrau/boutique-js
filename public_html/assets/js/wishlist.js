const body = document.body;
let currentWishlist = []

body.addEventListener('click', function (event) {
    if (event.target.classList.contains('favorites')) {
        console.log(event.target.getAttribute('id'));
        if (currentWishlist.includes(event.target.getAttribute('id'))) {
            console.log('already in favorites');
            // currentWishlist.splice(currentWishlist.indexOf(event.target.getAttribute('id')), 1);
            console.log(currentWishlist);
        } else {
            currentWishlist.push(event.target.getAttribute('id'));
            console.log(currentWishlist);
        }
    }
});