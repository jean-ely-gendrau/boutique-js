const jwt = require('jsonwebtoken');
const express = require('express');
const app = express();

app.post('/connexion', (req, res) => {
  // Extract email from request body
  let data = req.body.email;

  // Define the secret key
  let key = "secret";

  // Generate the JWT token
  let token = jwt.sign({ data }, key, { 
    expiresIn: '1h',
    algorithm: "HS256"


  });

  // Send the token to the cookie

  res.cookie('token', token, { httpOnly: true });
  res.send("Token generated and sent to the cookie");
});