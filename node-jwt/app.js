const express = require ('express');


const jwt = require('jsonwebtoken');


const cookieParser = require("cookie-parser");


const app = express();


app.use(cookieParser());

app.listen (3000, () =>{
    console.log("le serveur est lancer depuis le port 3000");
});


app.get("/hello", (request,response) => {
    console.log("hello");
    response.send("hello");
});

app.post("/jwtsign", (request,response) => {
  console.log("jwt sign");
  let data = request.cookies.email;
//let data = "email";
  console.log(data);

  // Define the secret key
  let key = "secret";

  console.log(key);

  // Generate the JWT token
  let token = jwt.sign({ data }, key, { 
    expiresIn: '1h',
    algorithm: "HS256"

  });

  // Send the token to the cookie

  response.cookie('token', token, { httpOnly: true }); // Send the token to the cookie 
  response.cookie('key', key, { httpOnly: true }); // Send the key to the cookie
  response.send("Token generated and sent to the cookie");
})

app.post("/jwtverify",(request,response) => {
    console.log("jwt verify");
    const token = request.cookies.token; // Extract the token from the cookie

    console.log(token);

    const key = request.cookies.key; // Extract the key from the cookie

    console.log(key);

    var decoded = jwt.decode(token); // Decode the token

    console.log(decoded);


    jwt.verify(token , key , { algorithms : "HS256" , expiresIn: '1h' }, function(err, decoded) {
        if (err) {
            console.log(err);
            console.log("c'est pas ok");
            response.status(401).send("Token verification failed");
          } else {
            console.log(decoded);
            console.log("c'est ok");
            response.send("Token verification successful");
          }
    });
})