const router = require("express").Router();
const fs = require("fs");

module.exports = function () {
  // Route API Static - Image
  router.get("/api/g/images", async (req, res) => {
    try {
      // Réponse avec l'image séléctionner dans le paramètre de l'url /?images_name=nom_image
      res.json(
        `http://localhost:81/static/${req.query.images_name}
        }`
      );
    } catch (error) {
      // Réponse 404 si une erreur ce produit
      res.status(404).json({ error: "Ooops erreur 404" });
    }
  });

  // Route Pour séléctionner une image aléatr
  router.get("/api/g/images/random", async (req, res) => {
    // Répertoire des images
    const images_directory = "./images/";

    // Lecture du fichier image et ajout des fichiers dans la variable
    let files = fs.readdirSync(images_directory);

    try {
      // Réponse Json d'une image aléatoire contenu dans le dossier
      res.json(
        `http://localhost:81/static/${
          files[Math.floor(Math.random() * files.length)]
        }`
      );
    } catch (error) {
      // Réponse 404 si une erreur ce produit
      res.status(404).json({ error: "Ooops erreur 404" });
    }
  });
  return router;
};
