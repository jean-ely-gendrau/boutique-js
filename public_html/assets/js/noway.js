document.getElementById('submitSubCat').addEventListener('click', function (event) {
    var selectElement = document.getElementById('counterSubCat');
    var selectedValue = selectElement.value;
    var textDiv = document.getElementById('text');
   
    if (selectedValue === '99') {

        textDiv.innerHTML = "Veuillez sélectionner une sous-catégorie"; 
        event.preventDefault();
    }
});