const express = require('express');
const router = express.Router();
const usersService = require('../services/users');
const booksService = require('../services/books');
const bcrypt = require('bcryptjs')
const pool = require('../config/database')

// GET /login
router.get('/login', (req, res) => {
  res.render('account/login');
});

// POST /login
router.post('/login', async (req, res) => {
  const { username, password } = req.body;
  const user = await usersService.findByUsername(username);

  if (!user) {
    console.log('Id')
    return res.render('account/login', { error: "Nom d'utilisateur ou mot de passe incorect" });
  }

  const valid = await usersService.verifyPassword(password, user.password);
  if (!valid) {
    return res.render('account/login', { error: "Nom d'utilisateur ou mot de passe incorect" });
  }

  if (user.password.startsWith('$2y$')) {
    const newHash = await bcrypt.hash(password, 10);
    await pool.query('UPDATE users SET password = ? WHERE id = ?', [newHash, user.id]);
  }

  req.session.userId = user.id;

  const redirectTo = req.session.returnTo?.startsWith('/') ? req.session.returnTo : '/';
  delete req.session.returnTo;
  res.redirect(redirectTo);
});

// GET /signin
router.get('/signin', (req, res) => {
  res.render('account/signin');
});

// POST /signin
router.post('/signin', async (req, res) => {
  const { username, first_name, last_name, email, password } = req.body;
  console.log(req.body)

  const mailExisting = await usersService.findByEmail(email);
  if (mailExisting) {
    return res.render('account/signin', { error: 'Email déjà utilisé' });
  }

  const usernameExisting = await usersService.findByUsername(username);
  if (usernameExisting) {
    return res.render('account/signin', { error: 'Nom d\'utilisateur déjà utilisé' });
  }

  const id = await usersService.create(username, first_name, last_name, email, password);
  req.session.userId = id;
  
  const redirectTo = req.session.returnTo?.startsWith('/') ? req.session.returnTo : '/';
  delete req.session.returnTo;
  res.redirect(redirectTo);
});

// GET /logout
router.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/');
});

// GET /user/:username
router.get('/user/:username', async (req, res) => {
  const user = await usersService.findByUsername(req.params.username);
  const books = await booksService.getBookByProprietaire(user.id)
  console.log(user.id)

  if (!user) {
    return res.status(404).render('404');
  }

  res.render('account/profile', { profile: user, books: books });
});


module.exports = router;