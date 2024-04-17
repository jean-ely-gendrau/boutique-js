
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(event.target);

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



let sql = 'UPDATE users SET name = ?, password = ?, birthday = ?, adress = ? WHERE id = ?';
let data = ['New Name', 'New Password', '1990-01-01', 'New Address', 1];

connection.query(sql, data, function(error, results, fields) {
  if (error) throw error;
  console.log('Updated ' + results.affectedRows + ' rows');
});

connection.end();
});
