const selectSubCat = document.getElementById('counterSubCat');
const buttonExpensive = document.getElementById('expensive');
const buttonCheaper = document.getElementById('cheaper');
const buttonBestSeller = document.getElementById('bestSeller');
const buttonBestRated = document.getElementById('bestRated');
const filterButtons = document.querySelectorAll('.filters');
let buttonValue;
let inFav;
const buttonClear = document.getElementById('clear');
const plusButton = document.getElementById('next_button');
const lastButton = document.getElementById('last_button');
const numberPages = document.getElementById('number_pages');
const currentPage = document.getElementById('select_pages');
let pages;



if (selectSubCat !== null) {
  document.addEventListener("DOMContentLoaded", function () {
    selectSubCat.selectedIndex = 0;
  })
}

function pagesArray(array, pagesSize) {
  const pages = [];
  for (let i = 0; i < array.length; i += pagesSize) {
    pages.push(array.slice(i, i + pagesSize));
  }
  return pages;
}

const currentPageUrl = window.location.origin;
const currentPagePath = window.location.pathname;
const regexUrl = /\/produit\/(\d+)(?:\/(\d+))?/;
const matchUrl = currentPagePath.match(regexUrl);
const idCat = matchUrl ? parseInt(matchUrl[1]) : null;

if (buttonClear !== null) {
  buttonClear.addEventListener('click', function () {
    buttonValue = null;
    messageResearch.innerText = '';
    selectSubCat.selectedIndex = 0;
    window.location.href = `${currentPageUrl}/produit/${idCat}`;
    filterPrice();
  });
}

console.log(currentPagePath);

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
      pages = pagesArray(products, 9);
      // console.log(pages);
      if (products.length <= 0) {
        messageResearch.innerText = 'Aucun résultat';
      } else if (filterSelected !== null) {
        messageResearch.innerText = message;
      }

      plusButton.addEventListener('click', function (event) {
        event.preventDefault();
      });

      lastButton.addEventListener('click', function (event) {
        event.preventDefault();
      });

      numberPages.value = pages.length;

      currentPage.value = 1;

      showProducts(pages[0]);
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
}

filterButtons.forEach(button => {
  button.addEventListener('click', event => {
    buttonValue = event.target.value
    if (selectSubCat.value === '0') {
      filterPrice(buttonValue, null);
    } else {
      filterPrice(buttonValue, selectSubCat.value);
    }
  });
});

if (selectSubCat !== null) {
  selectSubCat.addEventListener('change', function () {
    if (buttonValue === undefined && selectSubCat.value === '0') {
      filterPrice();
    } else if (selectSubCat.value === '0' && buttonValue !== undefined) {

      filterPrice(buttonValue, null);
    }
    else if (buttonValue === undefined) {
      filterPrice(null, selectSubCat.value);
    } else {
      filterPrice(buttonValue, selectSubCat.value);
    }
  });
}

function showProducts(page) {
  page.forEach(product => {
    if (product.user_has_product !== null) {
      inFav = 'inFav ';
    } else {
      inFav = null;
    }

    const productCard = document.createElement('div');
    productCard.innerHTML = `
          <div class="bg-gray-100 rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all relative">
              <div id="${product.id}" class="${inFav} favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 inline-block" width="22px" viewBox="0 0 192 192">
                      <path d="M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z" style="clip-rule:evenodd;display:inline;fill:${inFav === 'inFav ' ? 'rgb(235, 55, 55)' : 'none'};stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1"></path>
                  </svg>
              </div>
              <div id="${product.id}" class="w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8 article-image">
                  <img src="${currentPageUrl}/assets/images/loading.gif" alt="Loading..." class="h-full w-full object-contain" id="productImage_${product.id}" />
              </div>
              <div class="text-center mt-4">
                  <h3 id="${product.id}" class="article-name text-lg font-extrabold text-gray-800">${product.name}</h3>
                  <h4 class="text-2xl text-gray-800 font-bold mt-4">${product.price} € </h4>
                  <button data-js="handelPost,click" data-route="http://<?= $serverName ?>/addtobasket/${product.id}" type="button" class="w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 512 512">
                          <path d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0" data-original="#000000"></path>
                      </svg>
                      Ajouter au panier
                  </button>
              </div>
          </div>
      `;

    testImageUrl(`${currentPageUrl}/assets/images/${product.url_image}`, `productImage_${product.id}`);

    resultat.appendChild(productCard);
  });
  handleArticleClick();
}

function testImageUrl(url, imgId) {
  const img = new Image();
  img.onload = function () {
    const imgElement = document.getElementById(imgId);
    if (imgElement) {
      imgElement.src = url;
    }
  };
  img.onerror = function () {
    const imgElement = document.getElementById(imgId);
    if (imgElement) {
      imgElement.src = `${currentPageUrl}/assets/images/tea-coffee.png`;
    }
  };
  img.src = url;
}

function plusPage() {
  const currentPageNumber = parseInt(currentPage.value);
  if (currentPageNumber < pages.length) {
    currentPage.value = currentPageNumber + 1;
    resultat.innerText = '';
    showProducts(pages[currentPageNumber]);
  }
}

function minusPage() {
  const currentPageNumber = parseInt(currentPage.value);
  if (currentPageNumber > 1) {
    currentPage.value = currentPageNumber - 1;
    resultat.innerText = '';
    showProducts(pages[currentPageNumber - 2]);
  }
}

plusButton.addEventListener('click' , plusPage);
lastButton.addEventListener('click' , minusPage);