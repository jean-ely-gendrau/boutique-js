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
    console.log(localStorage.theme);
    return this;
  },
};

teaCoffee.format = {
  /**
   * - Tableau de stockage des paramètre du corps de la requête formatée.
   * @type {Array<string>}
   */
  bufferBodyParams: [],
  /**
   * - Ajoute les paramètres du corps de la requête à un tableau bufferBodyParams pour être utilisés ultérieurement.
   * @param {Object.<string, string>} bodyParam - Les paramètres du corps de la requête.
   * @returns {Object} - Retourne l'objet this pour permettre le chaînage des méthodes.
   */
  bodyParam: function (bodyParam) {

    let tempBodyParam = [];

    tempBodyParam.push(
      Object.entries(bodyParam)
        .map(([key, val], index) => {
          return `${key}=${val}`;
        })
        .join("&")
    );

    this.bufferBodyParams = tempBodyParam;
    return this;
  },
  /**
   * Ajoute les paramètres d'un formulaire à un tableau bufferBodyParams pour être utilisés ultérieurement.
   * @param {HTMLFormElement} form - Le formulaire HTML contenant les paramètres.
   * @returns {Object} - Retourne l'objet this pour permettre le chaînage des méthodes.
   */
  formParam: function (form) {

    let tempBodyParam = [];
    let formData = new FormData(form);

    tempBodyParam.push(
      Array.from(formData)
        .map(([key, val]) => {
          return `${key}=${val}`;
        })
        .join("&")
    );

    this.bufferBodyParams = tempBodyParam;
    return this;
  },
};

teaCoffee.validate = {
  /**
   * validateValue
   * Verifier des valeurs d'input
   *
   * @param {Object} options - Les options de la requête.
   * @param {string} [options.switchCase] - L'action du switch à effectuer
   * @param {MouseEvent|KeyboardEvent} event - L'événement de clic de souris | clavier déclenché.
   * @returns {object|bool} - Une objet json ou un booléan si tout c'est bien passée.
   */
  validateValue: ({ switchCase, event }) => {
    let boolValidate;
    switch (switchCase) {
      case 'number_min_max':
        if (event.target.dataset.min && event.target.dataset.max && event.target.value && event.target.name) {
          let minParse = parseInt(event.target.dataset.min);
          let maxParse = parseInt(event.target.dataset.max);
          let valueInput = parseInt(event.target.value);
          boolValidate = (!isNaN(valueInput) && valueInput >= minParse && valueInput <= maxParse)

          teaCoffee.html.addAndCleanErrorHtmlColorInput({ keyInput: event.target.name, boolValidate: boolValidate });
        }
    }

    return boolValidate;
  },
}
teaCoffee.request = {
  /**
   *
   * Effectue une requête HTTP POST vers une URL spécifiée.
   * Envoyer des données à partir de formulaires HTML ou d'objets JSON
   *
   * @param {Object} options - Les options de la requête.
   * @param {string} [options.route] - Le chemin de la route de l'API interne.
   * @param {string} [options.bodyParam] - Un objet JSON avec les données encapsulé.
   * @param {string|false} [options.idForm=false] - L'ID du formulaire à parser dans la reqête (par défaut: false).
   * @param {string} [options.method] - La méthode de la requête (par défaut: POST).
   * @param {string} [options.contentType="application/x-www-form-urlencoded"] - Le type de contenu de la requête (par défaut: application/x-www-form-urlencoded).
   * @param {string} [options.resType="json"] - Le type de réponse attendu (par défaut: json).
   * @param {string} [options.defineRequest] - L'URL complète si vous souhaitez joindre une API externe.
   * @param {Object|false} [options.headersParams=false] - Les paramètres d'en-tête personnalisés (par défaut: false).
   * @returns {Promise} - Une promesse contenant la réponse de la requête.
   *
   * Exemple d'utilisation simple :
   *
   * const response = await teaCoffee.request.post({
   *   route: '/sample-to-favoris',
   *   bodyParam: { users_id:6, product_id:10 }
   * });
   *
   * Exemple d'utilisation complet: connection utilisateur en utilisant la modale de la route /sample-modal-viewer
   *
   * const response = await teaCoffee.request.post({
   *   route: '/sample-connect-js',
   *   idForm: 'sample-form-connect',
   *   contentType: 'multipart/form-data',
   *   resType: 'text',
   * });
   */
  post: async ({
    route,
    bodyParam,
    idForm = false,
    method = "POST",
    contentType = "application/x-www-form-urlencoded",
    resType = "json",
    defineRequest,
    headersParams = false,
  }) => {
    let bodyParamFormat = "";
    console.log(route,
      bodyParam,
      idForm,
      method,
      contentType,
      resType,
      defineRequest,
      headersParams)

    // Condition si il y à un object JSON avec des query params à ajouter au body de la requête
    if (bodyParam && !idForm) {
      bodyParamFormat = teaCoffee.format.bodyParam(typeof bodyParam === 'string' ? eval('(' + bodyParam + ')') : bodyParam);
    }
    // Condition si on à un id de formulaire à inclure dans le body de la raquête. (le formulaire sera transfomer new FormData)
    else if (idForm && !bodyParam) {

      bodyParamFormat = teaCoffee.format.formParam(
        teaCoffee.sys.getById(idForm).elems[0]
      );
      teaCoffee.sys.elems.pop(); // CLEAN
    }
    // Condition si on à un object JSON avec des query params et id de formulaire (le formulaire sera transfomer new FormData) à inclure dans le body de la raquête
    else if (idForm && bodyParam) {

      teaCoffee.format.formParam(
        teaCoffee.sys.getById(idForm).elems[0]
      );
      teaCoffee.sys.elems.pop(); // CLEAN
      let tempFormatForm = teaCoffee.format.bufferBodyParams; // Assignation de la valeur

      teaCoffee.format.bodyParam(typeof bodyParam === 'string' ? eval('(' + bodyParam + ')') : bodyParam);
      let tempFormatBodyParam = teaCoffee.format.bufferBodyParams; // Assignation de la valeur

      teaCoffee.format.bufferBodyParams.pop(); // CLEAN

      teaCoffee.format.bufferBodyParams = tempFormatForm + '&' + tempFormatBodyParam; // Assignation de la concaténation

    }
    console.log(teaCoffee.format.bufferBodyParams);
    let defaultRequest = defineRequest
      ? defineRequest
      : `https://${window.location.hostname}${route}`;

    const res = await fetch(defaultRequest, {
      method: method,
      headers: headersParams
        ? headersParams
        : {
          "Content-Type": `${contentType}`,
        },
      body: teaCoffee.format.bufferBodyParams,
    });

    console.log(res);

    let response =
      resType === "json" ? res.json() : resType === "text" ? res.text() : false;

    return await response;
  },
  /**
   * Effectue une requête HTTP GET vers une URL spécifiée.
   * @param {Object} options - Les options de la requête.
   * @param {string} [options.route] - Le chemin de la route de l'API interne.
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
    let defaultRequest = defineRequest
      ? defineRequest
      : `https://${window.location.hostname}${route}`;

    const res = await fetch(defaultRequest, {
      method: "GET",
      headers: headersParams
        ? headersParams
        : {
          "Content-Type": `${contentType}`,
        },
    });

    let response =
      resType === "json" ? res.json() : resType === "text" ? res.text() : false;

    return await response;
  },
};

teaCoffee.html = {
  addAndCleanErrorHtmlMessage: function (key, objectMessage) {
    // On définit un id message-warn-{Nom de la balise en cour de focus out}
    let idWarn = `message-warn-${key}`;
    const elementWarn = document.getElementById(idWarn); // Sélection de la balise
    const elementError = document.getElementById(key); // Séléction de l'élément ou il y à une erreur
    console.log(key, objectMessage, elementError, elementWarn, objectMessage[key]);
    // Si le résultat de la requête retourn message erreurs et que l'élément de l'erreur existe bien sur la page.
    if (objectMessage !== true && elementError) {
      // On vérifie si la balise n'est pas dans le DOM
      if (elementWarn === null) {
        // On créer une balise paragraphe
        let elementText = document.createElement("p");
        elementText.setAttribute("id", idWarn); // On définit l'id
        elementText.setAttribute("class", "text-red-600 text-sm"); // On définit une classe text-danger
        elementText.textContent = objectMessage[key]; // On définit le text du paragraphe avec le message renvoyé par PHP
        console.log(elementText);
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
  /**
   * @param {Object} options - Les options de la requête.
   * @param {string} [options.keyInput] - L'attribut name de l'input en cours de validation
   * @param {bool} [options.boolValidate] - true si valie | false si la donnée n'as pas été validé
   */
  addAndCleanErrorHtmlColorInput: function (options) {
    const { keyInput, boolValidate } = options;
    const elementError = document.getElementById(keyInput); // Séléction de l'élément ou il y à une erreur

    // Vérifier si objectMessage
    if (boolValidate !== true && elementError) {
      elementError.classList.add("red-border");
    }

    if (boolValidate && elementError && elementError.classList.contains('red-border')) {
      elementError.classList.remove("red-border");
    }
  },
  /**
   * viewHtml Insérer/Remplace un élément HTML à la page
 * @param {Object} options - Les options de la vue html.
 * @returns {Object} - Retourne l'objet this pour permettre le chaînage des méthodes.
 */
  viewHtml: (options) => {
    let { replace = true, id, jsonElement } = options;
    let selected = null;
    // console.log(replace, id, jsonElement);
    teaCoffee.sys.getById(id);
    selected = teaCoffee.sys.elems[0]; // Assignation de valeur à une variable
    teaCoffee.sys.elems.pop()
    //  console.log(teaCoffee.sys.elems[0]);
    if (replace && selected) {
      let elementHtml = new DOMParser().parseFromString(jsonElement, "text/html");

      selected.replaceWith(elementHtml.documentElement.querySelector('body').firstChild);
    }
  },
};

teaCoffee.response = {
  success: function (callback, message) {
    console.log(callback, message)
  }, errors: function (callback, message) {
    console.error(callback, message)
  }
}

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
  /**
   * Gère l'événement de clic de souris pour l'exemple.
   * @param {MouseEvent} e - L'événement de clic de souris déclenché.
   * @returns {Promise<void>} - Une promesse résolue lorsque le traitement de l'événement est terminé.
   */
  handlePost: async (e) => {
    e.preventDefault();

    let { idForm, method, postUrl } = e.target.dataset;
    console.log(e.target.dataset);
    /*
    let objectPost = {};
      route: urlPost,
      idForm: idForm,
      method ? method: method,
      contentType: "application/x-www-form-urlencoded",
      resType: "json",
    }
    */

    // POST REQUEST
    const response = await teaCoffee.request.post(e.target.dataset);

    // Vérification de la présence d'une réponse, success ou errors
    if (response && response.hasOwnProperty('success')) {
      teaCoffee.response.success(response)

    } else if (response && response.hasOwnProperty('errors')) {
      teaCoffee.response.errors(response)

    }

  },
  /**
   * Gère l'événement de clic de souris pour l'exemple.
   * @param {MouseEvent} e - L'événement de clic de souris déclenché.
   * @returns {Promise<void>} - Une promesse résolue lorsque le traitement de l'événement est terminé.
   */
  handleFetch: async (e) => {
    e.preventDefault();

    let { idForm, method, postUrl } = e.target.dataset;
    console.log(e.target.dataset);
    /*
    let objectPost = {};
      route: urlPost,
      idForm: idForm,
      method ? method: method,
      contentType: "application/x-www-form-urlencoded",
      resType: "json",
    }
    */

    // POST REQUEST
    const response = await teaCoffee.request.fetch(e.target.dataset);
    /*
      // Vérification de la présence d'une réponse, ainsi que de la propriété 'isConnected' dans cette réponse, en s'assurant que cette propriété est de type booléen et a la valeur true
      if (response && response.hasOwnProperty('success')) {
     teaCoffee.response.success(response)
      }
      // Vérification de la présence d'une réponse, ainsi que de la propriété 'errors' dans cette réponse
      else if (response && response.hasOwnProperty('errors')) {
        // Transforme l'objet de la réponse en tableau associatif de keyInput => errorMessage
        Object.entries(response.errors).forEach(([keyInput, errorMessage], index) => {
          // 
          let errorObject = {
            [keyInput]: errorMessage,
          }
          teaCoffee.html.addAndCleanErrorHtmlMessage(keyInput, errorObject)
        });
    */
  },
  /** handleViewHtml
    * Gère l'événement de clic de souris pour l'exemple.
    * @param {MouseEvent} e - L'événement de clic de souris déclenché.
    * @returns {Promise<void>} - Une promesse résolue lorsque le traitement de l'événement est terminé.
    */
  handleViewHtml: async (e) => {
    e.preventDefault();

    let urlPost = e.target?.getAttribute('data-route'); // data attribute
    let targetId = e.target?.getAttribute('data-target-id'); // data attribute
    let replace = e.target?.getAttribute('data-replace'); // data attribute
    let idForm = e.target?.getAttribute('data-form-id'); // data attribute
    let bodyParam = { 'view-html': true, 'target-id': targetId, 'replace': replace };

    console.log(bodyParam);
    // POST REQUEST
    const response = await teaCoffee.request.post({
      route: urlPost,
      idForm: idForm,
      bodyParam: bodyParam,
      contentType: 'application/x-www-form-urlencoded',
      resType: 'json',
    });
    console.log(response);
    // Vérification de la présence d'une réponse, ainsi que de la propriété 'isConnected' dans cette réponse, en s'assurant que cette propriété est de type booléen et a la valeur true
    if (response && response.hasOwnProperty('htmlElement')) {
      teaCoffee.html.viewHtml({
        'id': targetId, 'jsonElement': response.htmlElement
      })
    }
    // Rechergement du loader JS
    teaCoffee.sys.loadLazyJS();
  },
  /**
  * Gère l'événement de clic de souris.
  * @param {MouseEvent} e - L'événement de clic de souris déclenché.
  */
  handleClick: (e) => {
    e.preventDefault();
    let linkUrl = e.target.getAttribute("data-link");
    let action = e.target.getAttribute("data-action");
    console.log(action);
    if (action) {
      switch (action) {
        case 'redirectByValue':
          let validateNumber = teaCoffee.validate.validateValue({ switchCase: 'number_min_max', event: e })
          console.log(validateNumber);
          linkUrl = linkUrl.replace('{{id}}', e.target.value);
          exit();
          window.location.assign(linkUrl);
          break;
        default:
          window.location.assign(linkUrl);
      }
    }
  },
  /**
 * Gère l'événement de clic de souris pour l'exemple.
 * @param {MouseEvent} e - L'événement de clic de souris déclenché.
 * @returns {Promise<void>} - Une promesse résolue lorsque le traitement de l'événement est terminé.
 */
  handleUpdateQuantity: async function (e) {
    e.preventDefault();
    let action = e.target?.getAttribute("data-action"); // data attribute
    let targetId = e.target?.getAttribute("data-target-id"); // data attribute
    let route = e.target?.getAttribute("data-route"); // data attribute
    let idForm = e.target?.getAttribute("data-id-form"); // data attribute

    const targetElement = document.getElementById(targetId);
    if (targetElement) {
      switch (action) {
        case 'up':
          targetElement.value = parseInt(targetElement.value) + 1;
          break;
        case 'down':
          targetElement.value = parseInt(targetElement.value) - 1;
          break;
      }

      if (route && idForm) {
        const response = await teaCoffee.request.post({
          route: route,
          idForm: idForm,
          contentType: "application/x-www-form-urlencoded",
          resType: "json",
        });

        console.log(response);
      }
    }
    console.log(e, action, targetId);
  },
  /***************************************************** SAMPLE METHODE */
  /**
   * Gère l'événement de clic de souris pour l'exemple.
   * @param {MouseEvent} e - L'événement de clic de souris déclenché.
   * @returns {Promise<void>} - Une promesse résolue lorsque le traitement de l'événement est terminé.
   */
  handleSampleConnect: async (e) => {
    e.preventDefault();

    let urlPost = e.target?.getAttribute("data-route"); // data attribute
    let idForm = e.target?.getAttribute("data-id-form"); // data attribute

    // POST REQUEST
    const response = await teaCoffee.request.post({
      route: urlPost,
      idForm: idForm,
      contentType: "application/x-www-form-urlencoded",
      resType: "json",
    });

    // Vérification de la présence d'une réponse, ainsi que de la propriété 'isConnected' dans cette réponse, en s'assurant que cette propriété est de type booléen et a la valeur true
    if (response && response.hasOwnProperty('isConnected') && response.isConnected === true) {
      window.location.assign('/'); // Redirect User 
    }
    // Vérification de la présence d'une réponse, ainsi que de la propriété 'errors' dans cette réponse
    else if (response && response.hasOwnProperty('errors')) {
      // Transforme l'objet de la réponse en tableau associatif de keyInput => errorMessage
      Object.entries(response.errors).forEach(([keyInput, errorMessage], index) => {
        // 
        let errorObject = {
          [keyInput]: errorMessage,
        }
        teaCoffee.html.addAndCleanErrorHtmlMessage(keyInput, errorObject)
      });

    }
  },
};
// LOAD MODULE
if (typeof module != "undefined" && module.exports) {
  module.exports = teaCoffee;
}

teaCoffee.sys.loadLazyImg();
teaCoffee.sys.loadLazyJS().darkMode();
/*
console.log(await teaCoffee.request.post(
  {
    route: '/sample-connect-js',
    bodyParam: { 'email': 'rbartosinski0@meetup.com', 'password': 'Rbartosinski083!' },
    contentType: "application/x-www-form-urlencoded",
    resType: "json",
  }));
  */