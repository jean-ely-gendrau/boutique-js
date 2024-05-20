// Fonction pour ajouter un produit au panier
function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    // Vérifie si le produit est déjà dans le panier
    const existingProduct = cart.find(item => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        product.quantity = 1;
        cart.push(product);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    // alert(`${product.name} has been added to your cart.`);
    // addItemToCart(cart)
}

// Fonction pour récupérer les produits du panier
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

// Fonction pour supprimer un produit du panier
function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(product => product.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Ajout d'événements aux boutons "Add to Cart"
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.getElementsByClassName('add-to-cart');
    Array.from(addToCartButtons).forEach(button => {
        button.addEventListener('click', (event) => {
            const productElement = event.target.closest('.product');
            const product = {
                id: productElement.getAttribute('data-id'),
                name: productElement.getAttribute('data-name'),
                price: parseFloat(productElement.getAttribute('data-price')),
                image: productElement.getAttribute('data-url'),
            };
            addToCart(product);
        });
    });
    addItemToCart()
});
// console.log(getCart())

function addItemToCart() {
    // console.log(cart[1]['name'])
    
    let cart = getCart()
    console.log(cart)
    let cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    const cartItems = document.getElementsByClassName('cart-items')[0]
    cartItems.innerHTML = ' '
    let cartRowContents = ''
    cart.forEach(element => {
        console.log(element['name']);  // Vérifiez que vous avez bien les données
        cartRowContents += `<div class="cart-item cart-column">
        <img class="cart-item-image" src="${element['image']}" width="100" height="100">
            <span class="">${element['name']}</span>
        </div>
        <span class="">${element['price']}</span>

        <div class="">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-danger" type="button">REMOVE</button>
        </div>`})
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    // cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeFromCart(id))
    // cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}










// if (document.readyState == 'loading') {
//     document.addEventListener('DOMContentLoaded', ready)
// } else {
//     ready()
// }
    
// function ready() {
// var removeCartItemButtons = document.getElementsByClassName('btn-danger')
// for (var i = 0; i < removeCartItemButtons.length; i++) {
//     var button = removeCartItemButtons[i]
//     button.addEventListener('click', removeCartItem)
// }

// var quantityInputs = document.getElementsByClassName('cart-quantity-input')
// for (var i = 0; i < quantityInputs.length; i++) {
//     var input = quantityInputs[i]
//     input.addEventListener('change', quantityChanged)
// }

// var addToCartButtons = document.getElementsByClassName('shop-item-button')
// for (var i = 0; i < addToCartButtons.length; i++) {
//     var button = addToCartButtons[i]
//     button.addEventListener('click', addToCartClicked)
// }

// document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
// }

// function removeCartItem(event) {
//     var buttonClicked = event.target
//     buttonClicked.parentElement.parentElement.remove()
//     updateCartTotal()
// }

// function quantityChanged(event) {
//     var input = event.target
//     if (isNaN(input.value) || input.value <= 0) {
//         input.value = 1
//     }
//     updateCartTotal()
// }

// function addToCartClicked(event) {
//     var button = event.target
//     var shopItem = button.parentElement.parentElement //parent element

//     var product = shopItem.getElementsByClassName('shop-item-title')[0].innerText
//     var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
//     var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
//     addItemToCart(product, price, imageSrc)
//     updateCartTotal()
// }

// /**
//  * Fonctionnalité de modal pour panier
//  * 
//  * @param {*} product 
//  * @param {*} price 
//  * @param {*} imageSrc 
//  * @returns 
//  */
// function addItemToCart(product, price, imageSrc) {
//     var cartRow = document.createElement('tr')
//     cartRow.classList.add('cart-row')
//     var cartItems = document.getElementsByClassName('cart-items')[0]
//     var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
//     for (var i = 0; i < cartItemNames.length; i++) {
//         // Condition for multiple add product
//     }
//     var cartRowContents = `
//         <td scope="col" class="cart-item px-6 py-3 text-center">
//             <img src='${imageSrc}' class='cart-item-image' alt='${product}' width="100" height="100">
//             <p class="cart-item-title">${product}</p>
//         </td>
//         <td scope="col" class="cart-price px-6 py-3 text-center">${price}</td>
//         <td scope="col" class="cart-quantity ">
//             <input class="cart-quantity-input" type="number" value="1">
//             <button class="btn-danger" type="button">Supprimer</button>
//         </td>
//         `
//     cartRow.innerHTML = cartRowContents
//     cartItems.append(cartRow)
//     cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
//     cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
// }

// function updateCartTotal() {
//     var cartItemContainer = document.getElementsByClassName('cart-items')[0]
//     var cartRows = cartItemContainer.getElementsByClassName('cart-row')
//     var total = 0
//     for (var i = 0; i < cartRows.length; i++) {
//         var cartRow = cartRows[i]
//         var priceElement = cartRow.getElementsByClassName('cart-price')[0]
//         console.log(priceElement)
//         var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
//         var price = parseFloat(priceElement.innerText.replace(' €', ''))
//         var quantity = quantityElement.value
//         total = total + (price * quantity)
//     }
//     total = Math.round(total * 100) / 100
//     document.getElementsByClassName('cart-total-price')[0].innerText = total + ' €' 
// }
