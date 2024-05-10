const selectSubCat = document.getElementById('counterSubCat');
const buttonExpensive = document.getElementById('expensive');
const buttonCheaper = document.getElementById('cheaper');
const buttonBestSeller = document.getElementById('bestSeller');
const buttonBestRated = document.getElementById('bestRated');
const filterButtons = document.querySelectorAll('.filters');
let buttonValue;
const buttonClear = document.getElementById('clear');

if (buttonClear !== null) {
  buttonClear.addEventListener('click', function () {
    buttonValue = null;
    messageResearch.innerText = '';
    selectSubCat.selectedIndex = 0;
    filterPrice();
  });
}

if (selectSubCat !== null) {
  document.addEventListener("DOMContentLoaded", function () {
    selectSubCat.selectedIndex = 0;
  })
}

const currentPageUrl = window.location.origin;
const currentPagePath = window.location.pathname;
const idCat = currentPagePath.charAt(currentPagePath.length - 1);

// console.log(currentPageUrl);

const resultat = document.getElementById('resultat');
const messageResearch = document.getElementById('paramsResarch');

function filterPrice(filter = null, subCat = null) {
  resultat.innerText = '';
  let filterSelected;
  let message;
  if (filter == 'expensive') {
    filterSelected = 'desc';
    message = 'Produits triés par prix décroissant';
  } else if (filter == 'cheaper') {
    filterSelected = 'asc';
    message = 'Produits triés par prix croissant';
  } else {
    filterSelected = filter;
    if (filterSelected === 'bestSeller') {
      message = 'Produits triés selon nos meilleures ventes.';
    }
    else if (filterSelected === 'bestRated') {
      message = 'Produits triés selon nos meilleures notes.';
    }
  }
  let myFetchRequest;
  if (filterSelected != null && subCat != null) {
    myFetchRequest = `/js-testBoth/${idCat}/${subCat}/${filterSelected}`;
  }
  else if (filterSelected != null) {
    myFetchRequest = `/js-testFilter/${idCat}/${filterSelected}`;
  } else if (subCat != null && subCat != 'subCatDefault') {
    myFetchRequest = `/js-testSub/${idCat}/${subCat}`;
  }
  if (filter === null && subCat === null) {
    myFetchRequest = `/js-testAll/${idCat}`;
  }
  // console.log(filterSelected);
  // console.log(myFetchRequest);
  const headers = new Headers();
  headers.append('Content-Type', 'application/json');
  fetch(myFetchRequest, {
    headers: headers
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(products => {
      // console.log(products);
      if (products.length <= 0) {
        messageResearch.innerText = 'Aucun résultat';
      } else if (filterSelected !== null) {
        messageResearch.innerText = message;
      }
      products.forEach(product => {
        // console.log(product.url_image);
        const productCard = document.createElement('div');
        productCard.classList.add('bg-gray-100', 'w-60', 'h-80', 'inline-block', 'relative', 'text-center', 'm-2.5', 'rounded-x1');

        const productImage = document.createElement('img');
        productImage.setAttribute('id', product.id);
        productImage.setAttribute('src', `${currentPageUrl}/assets/images/${product.url_image}`);
        productImage.setAttribute('alt', product.name);
        productImage.classList.add('article-image');
        productCard.appendChild(productImage);

        const productName = document.createElement('p');
        productName.setAttribute('id', product.id);
        productName.classList.add('mt-3', 'font-bold', 'article-name');
        productName.innerText = product.name;
        productCard.appendChild(productName);

        /// Create div for the favorite icon
        const favoriteDiv = document.createElement('div');
        favoriteDiv.setAttribute('id', product.id); // Add product id as id attribute
        favoriteDiv.classList.add('favorites', 'bg-gray-200', 'w-10', 'h-10', 'flex', 'items-center', 'justify-center', 'rounded-full', 'cursor-pointer', 'absolute', 'top-4', 'right-4');

        // Create SVG element
        const svgIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svgIcon.setAttribute('class', 'fill-gray-800 inline-block');
        svgIcon.setAttribute('width', '22px');
        svgIcon.setAttribute('viewBox', '0 0 192 192');

        // Create path element for the SVG icon
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z');
        path.setAttribute('style', 'clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1');

        // Append path to the SVG
        svgIcon.appendChild(path);

        // Append SVG to the favorite div
        favoriteDiv.appendChild(svgIcon);

        // Append favorite div to the product card
        productCard.appendChild(favoriteDiv);



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
}

filterButtons.forEach(button => {
  button.addEventListener('click', event => {
    buttonValue = event.target.value
    if (selectSubCat.value === 'subCatDefault') {
      filterPrice(buttonValue, null);
    } else {
      filterPrice(buttonValue, selectSubCat.value);
    }
  });
});

if (selectSubCat !== null) {
  selectSubCat.addEventListener('change', function () {
    if (buttonValue === undefined && selectSubCat.value === 'subCatDefault') {
      filterPrice();
    } else if (selectSubCat.value === 'subCatDefault' && buttonValue !== undefined) {

      filterPrice(buttonValue, null);
    }
    else if (buttonValue === undefined) {
      filterPrice(null, selectSubCat.value);
    } else {
      filterPrice(buttonValue, selectSubCat.value);
    }
  });
}