import { sign, verify, decode } from 'jsonwebtoken';


sign({
  data: 'foobar'
}, 'secret', { expiresIn: '1h' });




verify(token, 'shhhhh', function(err, decoded) {
  console.log(decoded.foo) // bar
});

var decoded = decode(token, {complete: true});
console.log(decoded.header);
console.log(decoded.payload);