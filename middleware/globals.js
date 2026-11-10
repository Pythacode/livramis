const categoriesService = require('../services/categories');
const authorsService = require('../services/author');
const { startswithAVoyelle } = require('../utils/helpers');

module.exports = async (req, res, next) => {
  res.locals.categories = await categoriesService.getCategories();
  res.locals.authors = await authorsService.getAuthor();
  res.locals.startswithAVoyelle = startswithAVoyelle;
  next();
};