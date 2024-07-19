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
                event.preventDefault();
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
                        image: imageElement?.getAttribute('src'), // Utilise 'src' au lieu de 'data-url'
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

const updateCartBarer = (cart) => {
    console.log(cart);
    const elementCartDetailsProduct = document.getElementById('cart-details-products');
    const elementCartDetailsUsers = document.getElementById('cart-details-users');
    const elementCartDetailsPrices = document.getElementById('cart-details-prices');

    elementCartDetailsProduct.textContent = cart.reduce((sum, item) => parseInt(sum) + (parseInt(item.quantity)), 0);

    elementCartDetailsPrices.textContent = cart.reduce((sum, item) => parseInt(sum) + (parseInt(item.price) * parseInt(item.quantity)), 0);

}
/**
 * Fonction saveCart
 * @param {Array} cart - Le panier à sauvegarder.
 * Sauvegarde le panier dans un cookie.
 */
function saveCart(cart, productId = null) {
    document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
    if (productId) updateItemToCart(productId);
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
    const footerCartDetails = document.getElementById('cart-details-barre');
    const cart = getCart();

    let cartRowContents = '';
    cart.forEach(element => {
        let elementNameSuffix = encodeURIComponent(element.name.replaceAll(' ', '\\n'));
        cartRowContents = `
          <div id="product-dom-element-${element.id}" class="relative cart-items flex bg-white p-6 rounded-lg shadow-md w-auto">
          <button data-id-product-cart="${element.id}" class="absolute right-0 top-0 button-delete-item-product bg-red-100 text-red-800 hover:text-red-700 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300 hover:dark:bg-red-800 dark:hover:text-red-200" type="button" data-id="${element.id}">supprimer</button>  
          <a href="/detail/${element.id}" class="absolute left-0 top-0 button-delete-item-product bg-green-800 text-green-100 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-300 dark:text-green-800 hover:dark:bg-red-800 hover:underline">${element.name}</a>  
          <div class="flex flex-row items-center min-w-full">
                <a href="#" class="md:mb-1">
                <img class="hidden dark:block w-18 h-18 md:w-24 md:h-24" src="${`https://placehold.co/600x400?font=lato&text=${elementNameSuffix}`}" alt="${element.name} image" />
                <img class="dark:hidden w-18 h-18 md:w-24 md:h-24" src="${`https://placehold.co/600x400?font=lato&text=${elementNameSuffix}`}" alt="${element.name} image" />
                </a>

                <div class="flex flex-row justify-center items-center mt-2 md:mt-3">
                    <div class="text-sm text-gray-700 dark:text-gray-300 flex flex-col justify-center items-center gap-y-2">
                        <div class="max-w-xs mx-auto">
                            <label for="quantity-input" class="bg-green-100 text-green-800 text-xs text-nowrap font-medium me-2 px-2.5 py-2.5 rounded-full dark:bg-green-900 dark:text-green-300">Quantité</label>
                            <div class="relative flex items-center max-w-[5rem]">
                                <button data-id-product-cart="${element.id}" type="button" id="decrement-button-cart-${element.id}" data-input-counter-decrement="quantity-input-item-cart-${element.id}" class="decrement-button-cart-item bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 w-4 border border-gray-300 rounded-s-lg p-3 h-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-2 h-2 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                                <input type="text" value="${element.quantity}" id="quantity-input-item-cart-${element.id}" data-input-counter aria-describedby="helper-text-explanation" class="cart-quantity-input bg-gray-50 border-x-0 border-gray-300 h-6 text-gray-900 text-xs focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                <button data-id-product-cart="${element.id}" type="button" id="increment-button-cart-${element.id}" data-input-counter-increment="quantity-input-item-cart-${element.id}" class="increment-button-cart-item bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 w-4 border border-gray-300 rounded-e-lg p-3 h-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-2 h-2 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>  
                    </div>
                    <div class="text-lg font-bold text-gray-900 dark:text-white flex flex-row gap-2 md:gap-4">
                        <div class="flex flex-col-reverse justify-center items-center gap-2 md:gap-4">
                            <span class="mr-2 text:sm md:text-base lg:text-lg font-extrabold">${element.price} €</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Tarif Ttc/unité</span> 
                        </div>
                        <div class="flex flex-col-reverse justify-center items-center gap-2 md:gap-4">
                            <span class="text-gray-500 dark:text-gray-400 text:base lg:text-xl">${element.price * element.quantity} €</span>
                            <span class="bg-green-100 text-green-800 text-xs text-nowrap font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Prix totals</span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

        let elementHtml = new DOMParser().parseFromString(cartRowContents, "text/html");
        cartItemsElement.appendChild(elementHtml.documentElement.querySelector('body').firstChild);
        updateCartBarer(cart);
    });
    refreshEvent();
}
/**
* Fonction updateItemToCart
* Met à jour l'affichage du panier avec les articles stockés dans le cookie.
*/
function updateItemToCart(productId) {
    const cartItemsElement = document.getElementById(`product-dom-element-${productId}`);

    if (!cartItemsElement && !productId) return null;

    const cart = getCart();// Récupérations des articles du cookie

    let cartRowContents = '';
    cart.forEach(element => {
        if (parseInt(element.id) === parseInt(productId)) {
            let elementNameSuffix = encodeURIComponent(element.name.replaceAll(' ', '\\n'));
            cartRowContents =
                `<div id="product-dom-element-${element.id}" class="cart-items flex bg-white p-6 rounded-lg shadow-md w-auto max-w-1/2 md:max-w-1/4 min-w-1/2 md:min-w-1/4">
                            <div class="flex flex-col items-center">
                                <a href="#" class="mb-2 md:mb-3">
                                <img class="hidden dark:block w-18 h-18 md:w-24 md:h-24 lg:w-52 lg:h-52" src="${`https://placehold.co/600x400?font=lato&text=${elementNameSuffix}`}" alt="${element.name} image" />
                                <img class="dark:hidden w-18 h-18 md:w-24 md:h-24 lg:w-52 lg:h-52" src="${`https://placehold.co/600x400?font=lato&text=${elementNameSuffix}`}" alt="${element.name} image" />
                                </a>
                                <div class="text-center flex max-w-sm p-4 md:p-6">
                                    <a href="/detail/${element.id}" class="text-base md:text-lg text-wrap font-semibold text-gray-900 dark:text-white hover:underline">${element.name}</a>
                                </div>
        
                                <div class="flex flex-col md:flex-row justify-between items-center w-full mt-2 md:mt-3">
                                    <div class="text-sm text-gray-700 dark:text-gray-300 flex flex-col justify-center items-center gap-y-2">
                                        <div class="max-w-xs mx-auto">
                                            <label for="quantity-input" class="block mb-1 md:mb-2 text-sm font-medium text-gray-900 dark:text-white">Choisir la quantité:</label>
                                            <div class="relative flex items-center max-w-[8rem]">
                                                <button data-id-product-cart="${element.id}" type="button" id="decrement-button-cart-${element.id}" data-input-counter-decrement="quantity-input-item-cart-${element.id}" class="decrement-button-cart-item bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                    </svg>
                                                </button>
                                                <input type="text" value="${element.quantity}" id="quantity-input-item-cart-${element.id}" data-input-counter aria-describedby="helper-text-explanation" class="cart-quantity-input bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                                <button data-id-product-cart="${element.id}" type="button" id="increment-button-cart-${element.id}" data-input-counter-increment="quantity-input-item-cart-${element.id}" class="increment-button-cart-item bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>  
                                    <button data-id-product-cart="${element.id}" class="button-delete-item-product bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300" type="button" data-id="${element.id}">supprimer</button>
                                    </div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">
                                        <div class="flex justify-right items-baseline m-4">
                                            <span class="mr-2 text:sm md:text-base lg:text-xl font-extrabold">${element.price} €</span>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Tarif Ttc/unité</span> 
                                        </div>
                                    </div>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text:base lg:text-xl">${element.price * element.quantity} €/(${element.quantity})</span>
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Prix totals/unité</span> 
                            </div>
                        </div>
                        `;
        }
    });
    let elementHtml = new DOMParser().parseFromString(cartRowContents, "text/html");
    //console.log(elementHtml.documentElement.querySelector('body').firstChild);
    cartItemsElement.replaceWith(elementHtml.documentElement.querySelector('body').firstChild);
    updateCartBarer(cart);
    refreshEvent();
}



function refreshEvent() {
    // Ajoute des écouteurs d'événements pour les boutons de suppression et les champs de quantité.
    const removeButtons = document.getElementsByClassName('button-delete-item-product');
    Array.from(removeButtons).forEach(button => {
        button?.addEventListener('click', (event) => {
            event.preventDefault();
            const productId = event.target.getAttribute('data-id-product-cart');
            removeFromCart(productId);
        });
    });

    const quantityInputs = document.getElementsByClassName('cart-quantity-input');
    Array.from(quantityInputs).forEach(input => {
        input.addEventListener('change', (event) => {
            event.preventDefault();
            console.log(event);
            const productId = event.target.getAttribute('data-id-product-cart');
            if (productId) {
                const newQuantity = parseInt(event.target.value);
                changeQuantity(productId, newQuantity);
            }
        });
    });

    const decrementButton = document.getElementsByClassName('decrement-button-cart-item');
    Array.from(decrementButton).forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const productId = event.target.getAttribute('data-id-product-cart');

            if (productId) {

                const elementInputQuantity = document.getElementById(`quantity-input-item-cart-${productId}`)
                if (elementInputQuantity) {
                    console.log('value', elementInputQuantity.value)
                    const newQuantity = parseInt(elementInputQuantity.value) - 1;
                    elementInputQuantity.value = newQuantity;
                    changeQuantity(productId, newQuantity);
                }
            }
        });
    });

    const incrementButton = document.getElementsByClassName('increment-button-cart-item');
    Array.from(incrementButton).forEach(button => {
        button?.addEventListener('click', (event) => {
            event.preventDefault();
            const productId = event.target.getAttribute('data-id-product-cart');

            if (productId) {
                const elementInputQuantity = document.getElementById(`quantity-input-item-cart-${productId}`)
                if (elementInputQuantity) {
                    console.log('value', elementInputQuantity.value);
                    const newQuantity = parseInt(elementInputQuantity.value) + 1;
                    elementInputQuantity.value = newQuantity;
                    changeQuantity(productId, newQuantity);
                }
            }
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
    saveCart(cart, productId);

    //addItemToCart();
}

/**
 * Fonction changeQuantity
 * @param {string} productId - L'ID du produit à modifier.
 * @param {number} newQuantity - La nouvelle quantité du produit.
 * Modifie la quantité d'un produit dans le panier.
 */
function changeQuantity(productId, newQuantity) {
    console.log('changeQuantity', productId, newQuantity);
    let cart = getCart();
    const product = cart.find(item => item.id === productId);
    if (product) {
        product.quantity = newQuantity > 0 ? newQuantity : 1; // Assurez-vous que la quantité est au moins 1
    }
    saveCart(cart, productId);
}
