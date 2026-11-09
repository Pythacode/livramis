const express = require('express');

const app = express();
const port = 3000;

require('dotenv').config();

// Configurer EJS
app.set('view engine', 'ejs');
app.set('views', './views');

app.use(express.static('public'));

const indexRouter = require('./routes/index');

app.use('/', indexRouter);

app.listen(port, () => {
  console.log(`Serveur listen on http://localhost:${port}`);
});

process.on('SIGINT', async () => {
  await pool.end(); // 👈 Fermer toutes les connexions de la pool
  console.log('✅ Pool de connexions fermée.');
  process.exit(0);
});