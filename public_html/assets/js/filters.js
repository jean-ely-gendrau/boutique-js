const selectOrderBy = document.getElementById('orderBy');
const selectSubCat = document.getElementById('counterSubCat');
const selectRatings = document.getElementById('rating');

document.addEventListener("DOMContentLoaded", function () {
  selectOrderBy.selectedIndex = 0;
  selectSubCat.selectedIndex = 0;
})

const currentPageUrl = window.location.origin;
const currentPagePath = window.location.pathname;
const idCat = currentPagePath.charAt(currentPagePath.length - 1);

// console.log(currentPageUrl);

const resultat = document.getElementById('resultat');

function filterPrice() {
  resultat.innerText = '';
    let order;
    // let rating = selectRatings.value
    // myFetchRequest = `/js-testRating/${idCat}/${rating}`;
    if (selectOrderBy.value == 'asc') {
      order = 'ASC';
    }
    if (selectOrderBy.value == 'desc') {
      order = 'DESC';
    }
    let myFetchRequest;
    if (selectOrderBy.value != 'orderByDefault' && selectSubCat.value != 'subCatDefault') {
      myFetchRequest = `/js-testBoth/${idCat}/${selectSubCat.value}/${order}`;
    }
    else if (selectOrderBy.value != 'orderByDefault') {
      myFetchRequest = `/js-testOrder/${idCat}/${order}`;
    } else if (selectSubCat.value != 'subCatDefault') {
      myFetchRequest = `/js-testSub/${idCat}/${selectSubCat.value}`;
    } 
    console.log(myFetchRequest);
    // console.log(order); 
    // console.log(selectSubCat.value);
    // console.log(myFetchRequest);
    // const minPriceInput = document.getElementById('prix').value;
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    fetch(myFetchRequest, {
      headers:headers
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(products => {
        // console.log(products);
        products.forEach(product => {
          // const images = JSON.parse(product.images);
          // console.log(product);
          const productCard = document.createElement('div');
          productCard.classList.add('bg-gray-100', 'w-60', 'h-80', 'inline-block', 'relative', 'text-center', 'm-2.5', 'rounded-x1');
          
          // const productImage = document.createElement('img');
          // productImage.setAttribute('id', product.id_product);
          // productImage.setAttribute('src', `${currentPageUrl}/assets/images/${images.main}`);
          // productImage.setAttribute('alt', product.name);
          // productImage.classList.add('article-image');
          // productCard.appendChild(productImage);
          
          const productName = document.createElement('p');
          productName.setAttribute('id', product.id_product);  
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
        handleArticleClick();
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    ;
  }