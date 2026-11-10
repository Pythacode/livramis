const categoriesService = require('../services/categories');

module.exports = async (req, res, next) => {
  res.locals.categories = await categoriesService.getCategories();
  next();
};