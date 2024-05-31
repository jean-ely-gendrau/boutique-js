// Gestion de la modal
var modal = document.getElementById("myModal");

// Récupère le bouton de la modal
var btn = document.getElementById("myBtn");

// Récupère l'élément span qui ferme la modal
var span = document.getElementsByClassName("close")[0];

// Quand l'utilisateur clique sur le bouton, ouvre la modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Quand l'utilisateur clique sur (x), ferme la modal
span.onclick = function() {
    modal.style.display = "none";
}

// Partout où l'utilisateur clique en dehors de la modal, ferme la modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}