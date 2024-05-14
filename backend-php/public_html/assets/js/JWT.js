jwt.sign({
        data: 'foobar'
    },
    'secret', 
    { 
        expiresIn: '1h' ,
        issuer: APIController,
        audience: user ,
        jwtid : 1,
        subject:getProduct,
    }
);

jwt.verify(
    'foobar', 
    "secret", 
    {
        issuer: APIController,
        jwtid: 1,
        audience: user,
    }, 
function(err, decoded) {
    console.log(decoded.foo) // bar
  });

var decoded = jwt.decode(token, {complete: true});
console.log(decoded.header);
console.log(decoded.payload);