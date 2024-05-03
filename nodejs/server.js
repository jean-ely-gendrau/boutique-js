const express = require('express')

const app = express()

app.get('/hello', (req, res)=>{
    res.send('<p>Hello World</p>')
})

app.listen(8081, ()=>{
    console.log("Serveur lancé sur localhost:8081 :.)")
})