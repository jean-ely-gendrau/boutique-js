// ----------     get pour detail     ----------

function handleArticleClick() {
    var articleImages = document.querySelectorAll(".article-image");
    var articleNames = document.querySelectorAll(".article-name");

    articleImages.forEach(function (articleImage) {
        articleImage.addEventListener("click", function () {
            var productID = this.getAttribute("id");
            window.location.href = "/detail/" + productID;
        });
    });

    articleNames.forEach(function (articleName) {
        articleName.addEventListener("click", function () {
            var productID = this.getAttribute("id");
            window.location.href = "/detail/" + productID;
        });
    });
}

document.addEventListener("DOMContentLoaded", handleArticleClick);