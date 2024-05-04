var teaCoffee = {};

// teaCoffee SYSTEM
teaCoffee.sys = {
  imagesBG: [],
  elems: [], // Tableau pour sauvegarder tous les éléments trouvés par les fonctions getById, getByClass
  // Récupère tous les éléments par ID
  // Peut prendre plus d'un paramètre
  getById: function () {
    var tempElems = []; // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === "string") {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.getElementById(arguments[i])); // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems; // Tous les éléments sont copiés dans la propriété elems
    return this; // Renvoie this dans l'ordre d'appel
  },
  getBySelector: function () {
    var tempElems = []; // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === "string") {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.querySelector(arguments[i])); // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems; // Tous les éléments sont copiés dans la propriété elems
    return this; // Renvoie this dans l'ordre d'appel
  },
  getBySelectorAll: function () {
    var tempElems = []; // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === "string") {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.querySelectorAll(arguments[i])); // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems; // Tous les éléments sont copiés dans la propriété elems
    return this; // Renvoie this dans l'ordre d'appel
  },
  // Ajoute une nouvelle classe à un élément
  // Cela ne supprime pas les autres classes, elle en ajoute simplement une nouvelle
  addClass: function (name) {
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].className += " " + name; // C'est ici qu'on ajoute la nouvelle classe
    }
    return this; // Renvoie this dans l'ordre d'appel
  },
  delClass: function (name) {
    for (var i = 0; i < this.elems.length; i++) {
      if (this.elems[i].classList.contains(name)) {
        this.elems[i].classList.remove(name); // retire la class
      }
    }
    return this; // Renvoie this dans l'ordre d'appel
  },
  hasClass: function (name) {
    for (var i = 0; i < this.elems.length; i++) {
      if (this.elems[i].classList.contains(name)) {
        return true;
      }
      return false;
    }
    return this; // Renvoie this dans l'ordre d'appel
  },
  // Ajoute un événement aux éléments trouvés par la méthode : getById et getByClass
  //-- Action est un type d'événement comme 'click', 'mouseover', 'mouseout', etc.
  //-- Callback est la fonction à exécuter lorsque l'événement est déclenché
  on: function (action, callback) {
    if (this.elems[0].addEventListener) {
      for (var i = 0; i < this.elems.length; i++) {
        this.elems[i].addEventListener(action, callback, false); //Ajout de l'événement du W3C pour Firefox,Safari,Opera...
      }
    } else if (this.elems[0].attachEvent) {
      for (var i = 0; i < this.elems.length; i++) {
        this.elems[i].attachEvent("on" + action, callback); // Ajout de l'événement pour Internet Explorer :(
      }
    }
    return this; // Renvoie this dans l'ordre d'appel
  },

  // Ajout du texte sur les éléments
  // text est la chaine à insérer
  appendText: function (text) {
    text = document.createTextNode(text); // Crée un nouveau noeud texte avec la chaine fournie
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].appendChild(text); // Ajoute le texte à l'élément
    }
    return this; // Renvoie this dans l'ordre d'appel
  },

  // Affiche ou masque les éléments trouvés
  toggleHide: function (e) {
    if (e) {
      console.log(e);
      e.preventDefault();
    }
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].style["display"] =
        this.elems[i].style["display"] === "none" || "" ? "block" : "none";
      // Vérifie le statut de l'élément pour savoir s’il peut être affiché ou masqué
    }
    return this; // Renvoie this dans l'ordre d'appel
  },
  loadLazyImg: function () {
    let imagesToLoad = document.querySelectorAll("img[data-src]");
    const loadImages = (image) => {
      image.setAttribute("src", image.getAttribute("data-src"));
      image.onload = () => {
        image.removeAttribute("data-src");
      };
    };
    imagesToLoad.forEach((img) => {
      this.imagesBG.push(img.getAttribute("data-src"));
      loadImages(img);
    });
    return this;
  },
  loadLazyJS: function () {
    let jsToLoad = document.querySelectorAll("*[data-js]");

    jsToLoad.forEach((dataElement) => {
      teaCoffee.sys.elems.push(dataElement);
      console.log(dataElement.getAttribute("data-js").split(",")[0]);
      teaCoffee.sys.on(
        dataElement.getAttribute("data-js").split(",")[1],
        eval(
          teaCoffee.action[dataElement.getAttribute("data-js").split(",")[0]]
        )
      );
      dataElement.removeAttribute("data-js");
      teaCoffee.sys.elems.pop();
    });
    return this;
  },
  darkMode: function () {
    // Implémente Dark mode celon les préferences utilisateur
    // Vérifie si une clé theme est accéssible dans localstorage
    // La clé theme est créer losque l'utilisateur choisit de basculer son affichage en mode ligth/dark
    if (
      localStorage.theme === "dark" ||
      (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
      document.documentElement.classList.add("dark");
    } else {
      document.documentElement.classList.remove("dark");
    }

    return this;
  },
  darkModeSwitch: function (e) {
    // Commutateur de mode ligth/dark
    // Pour changer les préference du navigateur on ajoute une clé au localstorage
    // Cette valeursera lu lors du chargement de page par la méthode darkMode
    if (!document.documentElement.classList.contains("dark")) {
      document.documentElement.classList.add("dark"); // Add Dark mode
      localStorage.theme = "dark"; // Ajout de la clé au localstorage
    } else {
      document.documentElement.classList.remove("dark"); // Remove Dark mode
      localStorage.theme = "light"; // Ajout de la clé au localstorage
    }
    return this;
  },
};

teaCoffee.request = {
  /**
   * Effectue une requête HTTP GET vers une URL spécifiée.
   * @param {Object} options - Les options de la requête.
   * @param {string} options.route - Le chemin de la route de l'API interne.
   * @param {string} [options.defineRequest] - L'URL complète si vous souhaitez joindre une API externe.
   * @param {string} [options.contentType="application/json"] - Le type de contenu de la requête (par défaut: application/json).
   * @param {string} [options.resType="json"] - Le type de réponse attendu (par défaut: json).
   * @param {Object|false} [options.headersParams=false] - Les paramètres d'en-tête personnalisés (par défaut: false).
   * @returns {Promise} - Une promesse contenant la réponse de la requête.
   *
   * Exemple d'utilisation simple d'utilisation :
   * 
   * const response = await teaCoffee.request.fetch({
   *   route: '/js-testAll/1',
   *   contentType: 'application/json'
   * });
   * 
   * Exemple d'utilisation complet d'utilisation avec l'ajout du header 'Authorization': 'Bearer myAccessToken' :
   * 
   * const response = await teaCoffee.request.fetch({
   *   route: '/js-testAll/1',
   *   contentType: 'application/json',
   *   resType: 'json',
   *   headersParams: {
   *     'Authorization': 'Bearer myAccessToken'
   *   }
   * });
   */
  fetch: async ({
    route,
    defineRequest,
    contentType = "application/json",
    resType = "json",
    headersParams = false,
  }) => {
    let defaultRequest = defineRequest ? defineRequest : `http://${window.location.hostname}${route}`;
    const res = await fetch(defaultRequest, {
      method: "GET",
      headers: headersParams
        ? headersParams
        : {
          "Content-Type": `${contentType}`,
        },
    });

    let response = resType === "json"
      ? res.json()
      : resType === "text"
        ? res.text()
        : false;

    return await response;
  },
};

teaCoffee.html = {
  addAndCleanErrorHtmlMessage: function (key, objectMessage) {
    // On définit un id message-warn-{Nom de la balise en cour de focus out}
    let idWarn = `message-warn-${key}`;
    const elementWarn = document.getElementById(idWarn); // Sélection de la balise
    const elementError = document.getElementById(key); // Séléction de l'élément ou il y à une erreur

    // Si le résultat de la requête retourn false
    if (objectMessage !== true) {
      // On vérifie si la balise n'est pas dans le DOM
      if (elementWarn === null) {
        // On créer une balise paragraphe
        let elementText = document.createElement("p");
        elementText.setAttribute("id", idWarn); // On définit l'id
        elementText.setAttribute("class", "text-red-600 text-sm"); // On définit une classe text-danger
        elementText.textContent = objectMessage[key]; // On définit le text du paragraphe avec le message renvoyé par PHP
        elementError.after(elementText); // On ajoute l'élément après l'élément qui initialise l'événement
      }
    } else {
      //Sinon tout c'est bien passé
      // Si elementWarn existe dans le DOM
      if (elementWarn) {
        elementWarn.remove(); // On le retire.
      }
    }
  },
};

teaCoffee.action = {
  handelScrollX: (e) => {
    var elemScrollX = e.target.getAttribute("data-scroll-x");

    // TODO Modifié l'appel des valeurs par data-scroll-value
    // var elemScrollX = e.target.getAttribute("data-scroll-x");

    var direction = e.target.getAttribute("data-direction-scroll");
    if (elemScrollX && direction) {
      var elementScroll = document.getElementById(elemScrollX);
      direction === "r"
        ? (elementScroll.scrollLeft += 355) // scroll to rigth
        : (elementScroll.scrollLeft += -355); // scoll to left
    }
  },
  darkSwitch: (e) => {
    teaCoffee.sys.darkModeSwitch(e);
  },
  debugToggle: (e) => {
    var elemId = e.target.getAttribute("data-id");
    if (elemId) {
      teaCoffee.sys.getById(...elemId.split(","));

      if (teaCoffee.sys.hasClass("debug-min")) {
        teaCoffee.sys.addClass("debug-max").delClass("debug-min");
      } else if (teaCoffee.sys.hasClass("debug-max")) {
        teaCoffee.sys.addClass("debug-min").delClass("debug-max");
      }
    }
  },
  getScrollXelements: function (element) {
    console.log(this);
    let elements = document.getElementById(element);
    if (elements) {
      let button =
        '<div class="z-10 bg-black"><button id="slideL" onclick="alert(\'ok\')" type="button">Slide left</button><button id="slideR" type="button">Slide right</button><div>';
      elements.innerHTML += button;
    }
  },
  validateRules: (e) => {
    var keyInput = e.target.getAttribute("data-key-input");
    var valuesInput = document.getElementById(keyInput);
    var messageClient = e.target.getAttribute("data-message");
    var regex = e.target.getAttribute("data-regex");
    let reponse;

    if (regex) {
      if (eval(regex).test(valuesInput.value)) {
        reponse = true; // Si le masque est bon true
      } else {
        reponse = {
          [keyInput]: messageClient,
        }; // si la condition n'a pas été remplie alors on retourne un message d'erreur
      }
    }
    teaCoffee.html.addAndCleanErrorHtmlMessage(keyInput, reponse);
  },
};
// LOAD MODULE
if (typeof module != "undefined" && module.exports) {
  module.exports = teaCoffee;
}

teaCoffee.sys.loadLazyImg();
teaCoffee.sys.loadLazyJS().darkMode();

