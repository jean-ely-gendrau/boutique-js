const jwt = require('jsonwebtoken');

let data = "angel.putz@laplateforme.io"

console.log(data);

// Sign the data into a JWT
let token = jwt.sign({
  data
}, 'secret', { expiresIn: '1h' });

console.log(token);

// Decode the token
var decoded = jwt.decode(token);

console.log(decoded);

// Verify the token
jwt.verify(token, 'secret', {}, function(err, decoded) {
  if (err) {
    console.log(err);
    console.log("c'est pas ok");
  } else {
    console.log(decoded);
    console.log("c'est ok");
  }
});