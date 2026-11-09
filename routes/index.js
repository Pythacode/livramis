// routes/index.js
const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
  res.render('index', {
    title: 'Accueil',
    message: 'Bienvenue sur mon site Node.js !'
  });
});

module.exports = router;
