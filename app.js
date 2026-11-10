require('dotenv').config();

const express = require('express');

const app = express();
const port = 3000;

const globals = require('./middleware/globals');
const session = require('./config/session');
const auth = require('./middleware/auth');

const indexRouter = require('./routes/index');
const accountRouter = require('./routes/account');

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static('public'));
app.use(session);
app.use(globals);
app.use(auth);

app.set('view engine', 'ejs');
app.set('views', './views');

app.use('/', indexRouter);
app.use('/', accountRouter);

app.listen(port, () => {
  console.log(`Serveur listen on http://localhost:${port}`);
});

process.on('SIGINT', async () => {
  await pool.end();
  console.log('Pool de connexions fermée.');
  process.exit(0);
});