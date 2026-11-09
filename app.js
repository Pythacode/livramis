// app.js
const express = require('express');
const app = express();
const port = 3000;

// Configurer EJS
app.set('view engine', 'ejs');
app.set('views', './views'); // Dossier des templates

app.use(express.static('public'));

const indexRouter = require('./routes/index');

// Utiliser les routes
app.use('/', indexRouter);

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Serveur démarré sur http://localhost:${port}`);
});
