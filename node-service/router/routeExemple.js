const router = require("express").Router();
const { fetchApi } = require("../components/fetchApi");

module.exports = function () {
  // Route exemple
  router.get("/api/paiement", async (req, res) => {
    //fetchApi(req, res, "url-de-l'api");
    res.json({ paiement: "valider" });
  });

  return router;
};
