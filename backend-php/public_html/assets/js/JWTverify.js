
var jwt = require('jsonwebtoken');

const express = require('express');

const app = express();


app.get('/connexion', (req, res) => {

const token= req.cookies.token;


// Decode the token
var decoded = jwt.decode(token);

console.log(decoded);

// Verify the token
jwt.verify(token,key, {
  algorithms : "ES256",
}, function(err, decoded) {
  if (err) {
    console.log(err);
    console.log("c'est pas ok");

    
  } else {
    console.log(decoded);
    console.log("c'est ok");
  }
});

});


