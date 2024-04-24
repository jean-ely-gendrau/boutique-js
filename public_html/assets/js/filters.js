const currentPageUrl = window.location.origin;
const currentPagePath = window.location.pathname;
console.log(currentPagePath.charAt(currentPagePath.length - 1));
console.log(currentPageUrl);
const resultat = document.getElementById('resultat');
function filterPrice() {
  resultat.innerText = '';
    const selectOrderBy = document.getElementById('orderBy').value;
    const selectSubCat = document.getElementById('counterSubCat').value;
    console.log(selectOrderBy); 
    console.log(selectSubCat);
    // const minPriceInput = document.getElementById('prix').value;
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    fetch(`/js-test/${selectSubCat}/${selectOrderBy}`, {
      headers:headers
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(products => {
        products.forEach(product => {
          const images = JSON.parse(product.images);
          console.log(product);
          const productCard = document.createElement('div');
          productCard.classList.add('bg-gray-100', 'w-60', 'h-80', 'i nline-block', 'relative', 'text-center', 'm-2.5', 'rounded-x1');
          
          const productImage = document.createElement('img');
          productImage.setAttribute('src', `${currentPageUrl}/assets/images/${images.main}`);
          productImage.setAttribute('alt', product.name);
          productImage.classList.add('article-image');
          productCard.appendChild(productImage);
          
          const productName = document.createElement('p');
          productName.classList.add('mt-3', 'font-bold', 'article-name');
          productName.innerText = product.name;
          productCard.appendChild(productName);
          
          const priceContainer = document.createElement('div');
          priceContainer.classList.add('flex', 'justify-center');
          
          const productPriceBold = document.createElement('p');
          productPriceBold.classList.add('mt-3', 'font-bold', 'mr-2');
          productPriceBold.innerText = `${product.price}€`;
          priceContainer.appendChild(productPriceBold);
          
          const productPriceMedium = document.createElement('p');
          productPriceMedium.classList.add('mt-3', 'font-medium', 'text-gray-300');
          productPriceMedium.innerText = `${product.price}€`;
          priceContainer.appendChild(productPriceMedium);
          
          productCard.appendChild(priceContainer);
          
          const addButton = document.createElement('button');
          addButton.setAttribute('type', 'button');
          addButton.classList.add('w-48', 'mt-4', 'px-4', 'py-3', 'bg-[#333]', 'hover:bg-[#222]', 'text-white', 'rounded-full');
          addButton.innerText = 'Add to cart';
          productCard.appendChild(addButton);
          
          resultat.appendChild(productCard);
        });
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    ;
  }