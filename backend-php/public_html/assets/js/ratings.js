const idProduct = document.querySelector(".produit");
const ratingProduct = document.querySelector('.rating');
const score1 = document.getElementById("score1");
const score2 = document.getElementById("score2");
const score3 = document.getElementById("score3");
const score4 = document.getElementById("score4");
const score5 = document.getElementById("score5");

if (idProduct !== null) {
    const rating = ratingProduct.getAttribute('id');
    // console.log(rating);
    if (rating <= 1.00) {
        // console.log(1);
        score1.classList.replace("fill-[#CED5D8]", "fill-gray-800");
    } else if (rating >= 1.01 && rating <= 2.00) {
        // console.log(2);
        score1.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score2.classList.replace("fill-[#CED5D8]", "fill-gray-800");
    } else if (rating >= 2.01 && rating <= 3.00) {
        // console.log(3);
        score1.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score2.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score3.classList.replace("fill-[#CED5D8]", "fill-gray-800");
    } else if (rating >= 3.01 && rating <= 4.00) {
        // console.log(4);
        score1.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score2.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score3.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score4.classList.replace("fill-[#CED5D8]", "fill-gray-800");
    } else if (rating >= 4.01 && rating <= 5.00) {
        // console.log(5);
        score1.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score2.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score3.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score4.classList.replace("fill-[#CED5D8]", "fill-gray-800");
        score5.classList.replace("fill-[#CED5D8]", "fill-gray-800");
    }

}