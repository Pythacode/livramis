const pool = require('../config/database');

class authorService {
  constructor(pool) {
    this.pool = pool
  }

  // Récupérer toute les autheurs
  async getAuthor() {
    try {
        const [rows] = await pool.query('SELECT `name` FROM `authors`');
        return rows;
    } catch (err) {
        console.error('Error:', err);
        throw err;
    }
  }

  async getAuthorById(id) {
    try {
        const [rows] = await pool.query('SELECT `name` FROM `authors` WHERE id = ?', [id]);
        return rows[0]?.name || null;
    } catch (err) {
        console.error('Error:', err);
        throw err;
    }
  }

  async getAuthorId(name) {
    try {
        const [rows] = await pool.query('SELECT id FROM `authors` WHERE name = ?', [name]);
        return rows[0]?.id || null;
    } catch (err) {
        console.error('Error:', err);
        throw err;
    }
  }

  async addAuthor(name) {
    try {
        const [result] = await pool.query(
            'INSERT INTO `authors` (name) VALUES (?)',
            [name]
        );
        return result.insertId;
    } catch (error) {
        console.error(error);
        throw error;
    }
  }
}

module.exports = new authorService(pool);