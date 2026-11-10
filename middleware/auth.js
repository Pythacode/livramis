const usersService = require('../services/users');

module.exports = async (req, res, next) => {
  if (req.session.userId) {
    res.locals.user = await usersService.findById(req.session.userId);
  } else {
    res.locals.user = null;
  }
  next();
};

module.exports.requireAuth = (req, res, next) => {
  if (!req.session.userId) {
    req.session.returnTo = req.originalUrl;
    return res.redirect('/login');
  }
  next();
};