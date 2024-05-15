const idProduct = document.querySelector(".produit");
const id = idProduct.getAttribute('id');

const headers = new Headers();
headers.append('Content-Type', 'application/json');

document.addEventListener('DOMContentLoaded', function () {
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    fetch(`/orderverif/${id}` , {headers: headers}).then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }).then(result => {
        console.log(result);
    }).catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});


