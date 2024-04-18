
modification.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(event.target);

    let Name = formData.get('name');
    let NewPassword = formData.get('nouveau_password');
    let NewDate = formData.get('brand');
    let NewAddress = formData.get('NewAddress');

    fetch('modification', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch((error) => console.error('Error:', error));

    const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'teacoffee'
});

connection.connect();



let sql = 'UPDATE users SET password = ?, birthday = ?, adress = ? WHERE name = ?';
let data = [ NewPassword, NewDate , NewAddress, Name];
 
connection.query(sql, data, function(error, results, fields) {
  if (error) throw error;
  console.log('Updated ' + results.affectedRows + ' rows');
});

connection.end();
});
