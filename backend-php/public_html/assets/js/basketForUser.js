const select = document.getElementById("myBtn");

select.addEventListener("click", () => {
    fetch(`http://${window.location.hostname}:8880/panier-modal`)
        .then(response => response.json())
        .then(data =>
            updateCart(data)
        )
        .catch(error => console.error('Error:', error));
});

function updateCart(data) {
    const cartItemsElement = document.querySelector('.cart-items');
    cartItemsElement.innerHTML = '';

    data.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item', 'cart-column', 'flex', 'flex-row');
        let srcImg = (`http://${window.location.hostname}:8880/assets/images/tea-coffee.png`);

        cartItem.innerHTML = `
            <img class="cart-item-image w-18" src="${srcImg}" width="100" height="100">
            <span class="">${item.name}</span>
            <span class="">${item.price} €</span>
            <div class="">
                <input class="cart-quantity-input w-20" type="number" value="1" data-id="${item.products_id}">
                <button class="btn-danger mr-auto" type="button" data-id="${item.products_id}">REMOVE</button>
            </div>
        `;

        cartItemsElement.appendChild(cartItem);
    });

    // Update total price
    updateCartTotal();
}

function updateCartTotal() {
    const cartItems = document.querySelectorAll('.cart-item');
    let total = 0;
    cartItems.forEach(item => {
        const priceElement = item.querySelector('span:nth-of-type(2)');
        const quantityElement = item.querySelector('.cart-quantity-input');
        const price = parseFloat(priceElement.innerText.replace(' €', ''));
        const quantity = quantityElement.value;
        total += price * quantity;
    });

    document.querySelector('.cart-total-price').innerText = total.toFixed(2) + ' €';
}

// Remove item from cart
document.addEventListener('click', (event) => {
    if (event.target.classList.contains('btn-danger')) {
        const productId = event.target.getAttribute('data-id');
        let bodyParamFormat = Object.entries({ product_id: productId })
            .map(([key, val], index) => {
                return `${key}=${val}`;
            })
            .join("&");
        fetch('/removefromcart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: bodyParamFormat
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                removeItemFromCart(productId); // Retire le produit du DOM
            })
            .catch(error => console.error('Error:', error));
    }
});

function removeItemFromCart(productId) {
    const cartItemsElement = document.querySelector('.cart-items');
    const cartItem = cartItemsElement.querySelector(`.btn-danger[data-id="${productId}"]`).closest('.cart-item');
    if (cartItem) {
        cartItemsElement.removeChild(cartItem);
    } else {
        console.error('Cart item not found');
    }

    // Update total price
    updateCartTotal();
}


function removeRowElement() {
    document.getElementById("myTable").deleteRow(0);
}
