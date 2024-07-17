// Vérifie si le document est encore en cours de chargement. Si oui, ajoute un écouteur pour lancer la fonction 'ready' une fois le document chargé.
if (document.readyState === 'loading') {
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
                        image: imageElement.getAttribute('src'), // Utilise 'src' au lieu de 'data-url'
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
 * Ajoute un produit au panier et met à jour le stockage dans le cookie.
 */
function addToCart(product) {
    let cart = getCart();
    const existingProduct = cart.find(item => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        product.quantity = 1;
        cart.push(product);
    }
    saveCart(cart);
    addItemToCart();
}

/**
 * Fonction saveCart
 * @param {Array} cart - Le panier à sauvegarder.
 * Sauvegarde le panier dans un cookie.
 */
function saveCart(cart) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
}

/**
 * Fonction getCart
 * @returns {Array} - Retourne le panier depuis le cookie.
 * Récupère les produits du panier depuis le cookie.
 */
function getCart() {
    const name = "cart=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return JSON.parse(c.substring(name.length, c.length)) || [];
        }
    }
    return [];
}

/**
 * Fonction addItemToCart
 * Met à jour l'affichage du panier avec les articles stockés dans le cookie.
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
        button?.addEventListener('click', (event) => {
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
 * Supprime un produit du panier et met à jour le stockage dans le cookie.
 */
function removeFromCart(productId) {
    let cart = getCart();
    cart = cart.filter(product => product.id !== productId);
    saveCart(cart);
    addItemToCart();
}

/**
 * Fonction changeQuantity
 * @param {string} productId - L'ID du produit à modifier.
 * @param {number} newQuantity - La nouvelle quantité du produit.
 * Modifie la quantité d'un produit dans le panier et met à jour le stockage dans le cookie.
 */
function changeQuantity(productId, newQuantity) {
    let cart = getCart();
    const product = cart.find(item => item.id === productId);
    if (product) {
        product.quantity = newQuantity > 0 ? newQuantity : 1; // Assurez-vous que la quantité est au moins 1
    }
    saveCart(cart);
    addItemToCart();
}
