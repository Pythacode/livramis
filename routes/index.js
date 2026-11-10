const bookService = require('../services/books');
const express = require('express');
const router = express.Router();

async function home(req, res) {
  try {
    const books = await bookService.getBooks(req.query.categorie);
    res.render('home', {books});
  } catch (err) {
    console.error('Erreur dans home:', err);
    res.status(500).send('Erreur serveur');
  }
}

router.get('/', home);

module.exports = router;