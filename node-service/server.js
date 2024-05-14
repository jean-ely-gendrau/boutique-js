const express = require("express");
const fs = require("fs");
//require("dotenv").config(); // Load environment variables

const app = express();
const port = 9999;

// Si le serveur dois retourner des fichiers index.html ou php
// On peu récupérer un paramètre avec req.query.nom_du_getter

app.get("/", (req, res) => {
  res.sendFile("index.html", { root: __dirname + "/templates/" });
});


// Route pour servir des images
app.use("/static", express.static("images/"));

const routes_directory = require("path").resolve(__dirname) + "/router/";

fs.readdirSync(routes_directory).forEach((route_file) => {
  try {
    app.use("/", require(routes_directory + route_file)());
  } catch (error) {
    console.log(`Une erreur viens de ce produire : ${route_file}`);
    console.log(error);
  }
});

app.listen(port, () => {
  console.log(`Le serveur est démarrée :  http://localhost:${port}`);
});
