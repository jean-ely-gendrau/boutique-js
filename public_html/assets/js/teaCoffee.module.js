var moduleTest = {}

// moduleTest SYSTEM
moduleTest.sys = {
  imagesBG: [],
  elems: [], // Tableau pour sauvegarder tous les éléments trouvés par les fonctions getById, getByClass
  // Récupère tous les éléments par ID
  // Peut prendre plus d'un paramètre
  getById: function () {
    var tempElems = [] // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === 'string') {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.getElementById(arguments[i])) // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems // Tous les éléments sont copiés dans la propriété elems
    return this // Renvoie this dans l'ordre d'appel
  },
  getBySelector: function () {
    var tempElems = [] // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === 'string') {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.querySelector(arguments[i])) // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems // Tous les éléments sont copiés dans la propriété elems
    return this // Renvoie this dans l'ordre d'appel
  },
  getBySelectorAll: function () {
    var tempElems = [] // tableau temporaire pour sauvegarder les éléments trouvés
    for (var i = 0; i < arguments.length; i++) {
      if (typeof arguments[i] === 'string') {
        // Vérifie que le paramètre est une chaine
        tempElems.push(document.querySelectorAll(arguments[i])) // Ajoute l'élément à tempElems
      }
    }
    this.elems = tempElems // Tous les éléments sont copiés dans la propriété elems
    return this // Renvoie this dans l'ordre d'appel
  },
  // Ajoute une nouvelle classe à un élément
  // Cela ne supprime pas les autres classes, elle en ajoute simplement une nouvelle
  addClass: function (name) {
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].className += ' ' + name // C'est ici qu'on ajoute la nouvelle classe
    }
    return this // Renvoie this dans l'ordre d'appel
  },
  delClass: function (name) {
    for (var i = 0; i < this.elems.length; i++) {
      if (this.elems[i].classList.contains(name)) {
        this.elems[i].classList.remove(name) // retire la class
      }
    }
    return this // Renvoie this dans l'ordre d'appel
  },
  // Ajoute un événement aux éléments trouvés par la méthode : getById et getByClass
  //-- Action est un type d'événement comme 'click', 'mouseover', 'mouseout', etc.
  //-- Callback est la fonction à exécuter lorsque l'événement est déclenché
  on: function (action, callback) {
    if (this.elems[0].addEventListener) {
      for (var i = 0; i < this.elems.length; i++) {
        this.elems[i].addEventListener(action, callback, false) //Ajout de l'événement du W3C pour Firefox,Safari,Opera...
      }
    } else if (this.elems[0].attachEvent) {
      for (var i = 0; i < this.elems.length; i++) {
        this.elems[i].attachEvent('on' + action, callback) // Ajout de l'événement pour Internet Explorer :(
      }
    }
    return this // Renvoie this dans l'ordre d'appel
  },

  // Ajout du texte sur les éléments
  // text est la chaine à insérer
  appendText: function (text) {
    text = document.createTextNode(text) // Crée un nouveau noeud texte avec la chaine fournie
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].appendChild(text) // Ajoute le texte à l'élément
    }
    return this // Renvoie this dans l'ordre d'appel
  },

  // Affiche ou masque les éléments trouvés
  toggleHide: function (e) {
    if (e) {
      console.log(e)
      e.preventDefault()
    }
    for (var i = 0; i < this.elems.length; i++) {
      this.elems[i].style['display'] =
        this.elems[i].style['display'] === 'none' || '' ? 'block' : 'none'
      // Vérifie le statut de l'élément pour savoir s’il peut être affiché ou masqué
    }
    return this // Renvoie this dans l'ordre d'appel
  },
  loadLazyImg: function () {
    let imagesToLoad = document.querySelectorAll('img[data-src]')
    const loadImages = (image) => {
      image.setAttribute('src', image.getAttribute('data-src'))
      image.onload = () => {
        image.removeAttribute('data-src')
      }
    }
    imagesToLoad.forEach((img) => {
      this.imagesBG.push(img.getAttribute('data-src'))
      loadImages(img)
    })
    return this
  },
  loadLazyJS: function () {
    let jsToLoad = document.querySelectorAll('*[data-js]')

    jsToLoad.forEach((dataElement) => {
      moduleTest.sys.elems.push(dataElement)
      console.log(dataElement.getAttribute('data-js').split(',')[0])
      moduleTest.sys.on(
        dataElement.getAttribute('data-js').split(',')[1],
        eval(
          moduleTest.action[dataElement.getAttribute('data-js').split(',')[0]]
        )
      )
      dataElement.removeAttribute('data-js')
      moduleTest.sys.elems.pop()
    })
    return this
  },
  darkMode: function () {
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (
      localStorage.theme === 'dark' ||
      (!('theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }

    // Whenever the user explicitly chooses light mode
    localStorage.theme = 'light'

    // Whenever the user explicitly chooses dark mode
    localStorage.theme = 'dark'

    // Whenever the user explicitly chooses to respect the OS preference
    localStorage.removeItem('theme')

    return this
  },
}

moduleTest.action = {
  handelScrollX: (e) => {
    var elemScrollX = e.target.getAttribute('data-scroll-x')
    var direction = e.target.getAttribute('data-direction-scroll')
    if (elemScrollX && direction) {
      var elementScroll = document.getElementById(elemScrollX)
      direction === 'r'
        ? (elementScroll.scrollLeft += 355) // scroll to rigth
        : (elementScroll.scrollLeft += -355) // scoll to left
    }
  },
  getScrollXelements: function (element) {
    console.log(this)
    let elements = document.getElementById(element)
    if (elements) {
      let button =
        '<div class="z-10 bg-black"><button id="slideL" onclick="alert(\'ok\')" type="button">Slide left</button><button id="slideR" type="button">Slide right</button><div>'
      elements.innerHTML += button
    }
  },
}
// LOAD MODULE
if (typeof module != 'undefined' && module.exports) {
  module.exports = moduleTest
}

// moduleTest.sys.loadLazyImg().darkMode()
moduleTest.sys.loadLazyJS()
