// Composant pour vos Request API avec axios
const axios = require("axios");

const API_ADDR = "URL_DE_API";

exports.fetchApi = async (req, res, endpoint) => {
  try {
    // ENV fichier
    const apiKey = process.env.API_KEY;
    //  Construction de la requête vers API avec voter apiKey
    const response = await axios.get(`${API_ADDR}/${endpoint}`, {
      headers: {
        accept: "application/json",
        Authorization: `Bearer ${apiKey}`,
      },
    });

    res.json(response.data);
  } catch (error) {
    res
      .status(500)
      .json({ error: "Ooops erreur 500 : " + error.response.status });
  }
};
