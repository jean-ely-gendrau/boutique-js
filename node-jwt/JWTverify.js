var jwt = require('jsonwebtoken');
const express = require('express');
const cookieParser = require('cookie-parser');

const app = express();
app.use(cookieParser());




console.log("ok");


app.get('/connexion', (req, res) => {
  const token = req.cookies.token;

    console.log(token);

  const key = req.cookies.key;

console.log(key);

  // Decode the token
  var decoded = jwt.decode(token);
  console.log(decoded);

  // Verify the token
  jwt.verify(token, key, { algorithms : "HS256" }, function(err, decoded) {
    if (err) {
      console.log(err);
      console.log("c'est pas ok");
      res.status(401).send("Token verification failed");
    } else {
      console.log(decoded);
      console.log("c'est ok");
      res.send("Token verification successful");
    }
  });
});