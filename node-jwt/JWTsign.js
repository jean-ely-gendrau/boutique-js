const jwt = require('jsonwebtoken');
const express = require('express');
const app = express();
app.use(require('cookie-parser')());


console.log("ok");



app.get('/connexion', (req, res) => {
  // Extract email from request body
  
});