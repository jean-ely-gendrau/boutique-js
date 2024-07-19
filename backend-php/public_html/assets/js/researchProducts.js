// Fonction pour nettoyer et encoder l'entrée utilisateur
function cleanAndEncodeQuery(str) {
    return encodeURIComponent(str.normalize('NFD').replace(/[\u0300-\u036f]/g, "").trim());
}

document.getElementById('search-product').addEventListener('input', function() {
    let query = this.value;

    if (query.length > 2) { // Start searching after 3 characters
        let cleanedQuery = cleanAndEncodeQuery(query); // Nettoyer et encoder la requête
        fetch(`/searchProduct/${cleanedQuery}`)
            .then(response => response.json())
            .then(data => {
                console.log(data)
                let suggestions = document.getElementById('suggestions');
                suggestions.textContent = '';

                if (Array.isArray(data)) {
                    data.forEach(product => {
                        let div = document.createElement('div');
                        div.classList.add('p-2', 'hover:bg-gray-200', 'cursor-pointer');
                        div.textContent = product.name;
                        div.addEventListener('click', function() {
                            document.getElementById('search-product').value = product.name;
                            suggestions.textContent = '';
                        });
                        suggestions.appendChild(div);
                    });
                } else {
                    console.error('Expected an array but received:', data);
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    } else {
        document.getElementById('suggestions').textContent = '';
    }
});
