const express = require('express')
const webpush = require('web-push')
const bodyParser = require('body-parser')
const path = require('path')
require('dotenv').config()

const routes = require('./routes/notifications')

const app = express()

app.use(express.static(path.join(__dirname, 'client')))

// Parsing json from from server to client
app.use(bodyParser.json())

// Routes
app.use('/api/v1/notifications', routes)

const PORT = process.env.PORT || 3000

app.listen(PORT, () => {
  console.log('Server started on port 3000')
})
