jwt.sign({
  data: 'foobar'
}, 'secret', 
{ expiresIn: '1h' }
, {audience: $_SESSION["email"]}
);




jwt.verify(token, 'shhhhh', function(err, decoded) {
  console.log(decoded.foo) // bar
});

var decoded = jwt.decode(token, {complete: true});
console.log(decoded.header);
console.log(decoded.payload);