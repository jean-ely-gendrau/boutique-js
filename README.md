# Bienvenu boutique-js

## Structure des dossiers du projet
boutique-js
├── config
├── element
├── public_html
│   └── assets
│       ├── images
│       ├── js
│       └── styles
├── src
│   ├── Components
│   ├── Controllers
│   ├── Interfaces
│   ├── Manager
│   └── Models
├── styles_import
├── template

### Pour initialiser le projet

1. Récupérer  le repositorie

    - Avec git en ligne de commande

    ```git
    git clone https://github.com/jean-ely-gendrau/boutique-js.git
    ```

    - Télécharger le repo et dézippez-le

3. Démarrer le projet dans votre IDE (VSCODE)

Depuis le terminal 

``` terminal
cd boutique-js

composer install
npm install
npm start
```
> [!TIP]
> npm start
> Dois être exécutés à chaque lancement du projet.

Cela permet de compiler le code css de tailwind et d'éviter de rentrer cette commande à chaque fois.

```json
 "scripts": {
    "start": "npx tailwindcss -i ./styles_import/styles.css -o ./public_html/assets/styles/global.css --watch"
  }
```
