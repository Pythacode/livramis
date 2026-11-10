const pool = require('../config/database');

class CategoriesService {
  constructor(pool) {
    this.pool = pool
  }

  // Récupérer tous les livres
  async getCategories() {
    try {
      const [rows] = await pool.query('SELECT `name` FROM `categories`');

      return rows;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  async getCategorieById(id) {
    try {
      const [rows] = await pool.query('SELECT name FROM categories WHERE id = ?', [id]);
      return rows[0] || null;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  async getCategorieIdByName(name) {
    try {
      const [rows] = await pool.query('SELECT id FROM categories WHERE name = ?', [name]);
      return rows[0]?.id || null;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }
}

module.exports = new CategoriesService(pool);