const express = require('express');
const router = express.Router();
const booksService = require('../services/books');
const authorsService = require('../services/author');
const categoriesService = require('../services/categories');
const { requireAuth } = require('../middleware/auth');
const clean = require('../utils/sanitize');
const fs = require('fs').promises;
const path = require('path');
const upload = require('../config/upload');
const auth = require('../middleware/auth');

router.get('/new', requireAuth, async (req, res) => {
  res.render('book/new');
});

router.post('/new', requireAuth, upload.single('cover'), async (req, res) => {
  try {
    const { title, author, key_word, categorie, resume } = req.body

    let authorId = await authorsService.getAuthorId(author)
    if (!authorId) {
      authorId = await authorsService.addAuthor(author)
    }

    const slug = booksService.generateUniqueSlug(title)
    const categorieId = await categoriesService.getCategorieIdByName(categorie);

    const cleanResume = clean(resume);
    const id = await booksService.addBook(title, cleanResume, authorId, req.session.userId, req.file ? 1 : 0, categorieId, slug);

    if (req.file) {
      const pngBuffer = await sharp(req.file.buffer)
        .png()
        .toBuffer();

      const filename = `${id}.png`;
      const dest = path.join(`public/books/`, filename);

      await fs.writeFile(dest, pngBuffer);
      await booksService.setCover(id, filename);
    }

    res.redirect(`/book/${slug}`);
  } catch (err) {
    console.error(err);
    res.render('book/new', { error: 'Erreur lors de la création' });
  }
});

// GET /book/bookname
router.get('/:slug', async (req, res) => {
  const book = await booksService.getBookBySlug(req.params.slug)

  if (!book) {
    return res.status(404).render('404');
  }

  res.render('book/book', { book: book });
});

module.exports = router;