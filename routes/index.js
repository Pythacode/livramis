const bookService = require('../services/books');
const categoriesService = require('../services/categories');
const express = require('express');
const router = express.Router();

async function home(req, res) {
  try {
    if (req.query.categorie) {
    }
    const books = await bookService.getBooks(req.query.categorie);
    const categories =  await categoriesService.getCategories();
    res.render('home', {books, categories});
  } catch (err) {
    console.error('Erreur dans home:', err);
    res.status(500).send('Erreur serveur');
  }
}

router.get('/', home);

module.exports = router;