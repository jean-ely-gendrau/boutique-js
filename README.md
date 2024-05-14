# Bienvenu sur la boutique TeaCoffee

## Structure des dossiers du projet
``` terminal
.
├── backend-php
│ ├── config
│ ├── element
│ ├── motorMVC
│ ├── public_html
│ ├── src
│ ├── styles_import
│ ├── template
│ ├── templateMail
│ └── vendor
├── docker-data
│ ├── dump
│ ├── images
│ ├── nginx_conf
│ └── php_conf
└── node-service
├── components
├── images
├── router
└── templates
```


### Pour initialiser le projet

1. Récupérer le repositorie

    - Avec git en ligne de commande

    ```git
    git clone https://github.com/jean-ely-gendrau/boutique-js.git
    ```

    - Télécharger le repo et dézippez-le


2. Démarrer le projet dans votre IDE (VSCODE)
   
 - Rendez-vous à la section du [WIKI docker](https://github.com/jean-ely-gendrau/boutique-js/wiki/Docker)
   pour bien commencer. 🚀


### Aide

> [!TIP]
> npm start
> Dois être exécutés à chaque lancement du projet.

Cela permet de compiler le code css de tailwind et d'éviter de rentrer cette commande à chaque fois.

```json
 "scripts": {
    "start": "npx tailwindcss -i ./styles_import/styles.css -o ./public_html/assets/styles/global.css --watch"
  }
```


> [!TIP]
> Procédure de mise à jour du projet avec git 
> en ligne de commande

Cela suppose que vous avez sauvegardé votre branche

```git
// à partir de la branche main (ou autres branche que l'on souhaite merge)
git pull

// On switch de branche
git checkout nom_de_la_branche

// On merge avec la branche main (ou autres branche que l'on souhaite merge)
git merge main
```



> [!TIP]
> Procédure de sauvegarde de votre branche 
> en ligne de commande

```git
// ajout de tous les fichiers modifiés
git add .

// Création du commit avec un message
git commit -m "message update"
