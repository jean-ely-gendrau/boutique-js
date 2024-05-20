// Vérifie si le document est encore en cours de chargement. Si oui, ajoute un écouteur pour lancer la fonction 'ready' une fois le document chargé.
// Sinon, lance la fonction 'ready' immédiatement.
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

/**
 * Fonction ready
 * Initialise les écouteurs d'événements après le chargement du DOM.
 */
function ready() {
    document.addEventListener('DOMContentLoaded', () => {
        // Sélectionne tous les boutons "Add to Cart" et ajoute un événement 'click' à chacun.
        const addToCartButtons = document.getElementsByClassName('add-to-cart');
        Array.from(addToCartButtons).forEach(button => {
            button.addEventListener('click', (event) => {
                const productElement = event.target.closest('.product');
                if (!productElement) {
                    console.error('Product element not found');
                    return;
                }
                
                const containerElement = productElement.closest('.product-container');
                const imageElement = containerElement.querySelector('.article-image');
                if (imageElement) {
                    const product = {
                        id: productElement.getAttribute('data-id'),
                        name: productElement.getAttribute('data-name'),
                        price: parseFloat(productElement.getAttribute('data-price')),
                        image: imageElement.getAttribute('data-url'),
                    };
                    addToCart(product);
                } else {
                    console.error('Image element not found');
                }
            });
        });

        // Met à jour l'affichage du panier avec les articles stockés.
        addItemToCart();
    });
}

/**
 * Fonction addToCart
 * @param {Object} product - L'objet produit à ajouter au panier.
 * Ajoute un produit au panier et met à jour le stockage local.
 */
function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const existingProduct = cart.find(item => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        product.quantity = 1;
        cart.push(product);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    addItemToCart();
}

/**
 * Fonction getCart
 * @returns {Array} - Retourne le panier depuis le stockage local.
 * Récupère les produits du panier depuis le stockage local.
 */
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

/**
 * Fonction addItemToCart
 * Met à jour l'affichage du panier avec les articles stockés dans le localStorage.
 */
function addItemToCart() {
    const cartItemsElement = document.getElementsByClassName('cart-items')[0];
    cartItemsElement.innerHTML = '';
    const cart = getCart();
    let cartRowContents = '';

    cart.forEach(element => {
        cartRowContents += `
            <div class="cart-item cart-column">
                <img class="cart-item-image" src="${element.image}" width="100" height="100">
                <span class="">${element.name}</span>
            </div>
            <span class="">${element.price} €</span>
            <div class="">
                <input class="cart-quantity-input" type="number" value="${element.quantity}" data-id="${element.id}">
                <button class="btn btn-danger" type="button" data-id="${element.id}">REMOVE</button>
            </div>
        `;
    });

    cartItemsElement.innerHTML = cartRowContents;
    // Ajoute des écouteurs d'événements pour les boutons de suppression et les champs de quantité.
    const removeButtons = document.getElementsByClassName('btn-danger');
    Array.from(removeButtons).forEach(button => {
        button.addEventListener('click', (event) => {
            const productId = event.target.getAttribute('data-id');
            removeFromCart(productId);
        });
    });

    const quantityInputs = document.getElementsByClassName('cart-quantity-input');
    Array.from(quantityInputs).forEach(input => {
        input.addEventListener('change', (event) => {
            const productId = event.target.getAttribute('data-id');
            const newQuantity = parseInt(event.target.value);
            changeQuantity(productId, newQuantity);
        });
    });
}

/**
 * Fonction removeFromCart
 * @param {string} productId - L'ID du produit à supprimer.
 * Supprime un produit du panier et met à jour le stockage local.
 */
function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(product => product.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    addItemToCart();
}

/**
 * Fonction changeQuantity
 * @param {string} productId - L'ID du produit à modifier.
 * @param {number} newQuantity - La nouvelle quantité du produit.
 * Modifie la quantité d'un produit dans le panier et met à jour le stockage local.
 */
function changeQuantity(productId, newQuantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const product = cart.find(item => item.id === productId);
    if (product) {
        product.quantity = newQuantity > 0 ? newQuantity : 1; // Assurez-vous que la quantité est au moins 1
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    addItemToCart();
}

// Gestion de la modal
var modal = document.getElementById("myModal");

// Récupére le bouton de la modal
var btn = document.getElementById("myBtn");

// Récupére l'élément span qui ferme la modal
var span = document.getElementsByClassName("close")[0];

// Quand l'utilisateur click sur le button, ouvre la modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Quand l'utilisateur click sur (x), ferme la modal
span.onclick = function() {
    modal.style.display = "none";
}

// Partout où l'utilisateur click en dehors de la modal, ferme la modal
window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
}