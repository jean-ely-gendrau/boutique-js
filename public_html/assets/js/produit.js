// ----------     si pas de sous catégorie selectionné     ----------

if (window.location.pathname.includes("produit")) {
    document.getElementById('submitSubCat').addEventListener('click', function (event) {
        var selectElement = document.getElementById('counterSubCat');
        var selectedValue = selectElement.value;
        var textDiv = document.getElementById('text');

        if (selectedValue === '99') {

            textDiv.innerHTML = "Veuillez sélectionner une sous-catégorie";
            event.preventDefault();
        }
    });
}

// ----------     get pour detail     ----------

document.addEventListener("DOMContentLoaded", function () {

    var articleImages = document.querySelectorAll(".article-image");
    var articleNames = document.querySelectorAll(".article-name");

    articleImages.forEach(function (articleImage) {
        articleImage.addEventListener("click", function () {

            var productID = this.getAttribute("id");
            window.location.href = "/detail/" + productID, "]";
        });

    });

    articleNames.forEach(function (articleName) {
        articleName.addEventListener("click", function () {
            var productID = this.getAttribute("id");
            window.location.href = "/detail/" + productID, "]";
        });
    })

})