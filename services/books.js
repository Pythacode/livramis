const pool = require('../config/database');
const categories = require('./categories')

class BookService {
  constructor(pool) {
    this.pool = pool
    this.userCache = new Map();
    this.categorieCache = new Map();
  }

  async book_process(book) {

    // Propriétaire
    const userId = book["user_id"];
    let username;

    if (this.userCache.has(userId)) {
      username = this.userCache.get(userId);
    } else {
      const [user] = await this.pool.query('SELECT username FROM users WHERE id = ?', [userId]);
      username = user[0]?.username;
      this.userCache.set(userId, username);
    }
    book["proprietaire"] = username;

    // Catégorie
    const categorieId = book["categorie"];
    let categorie;

    if (this.categorieCache.has(categorieId)) {
      categorie = this.categorieCache.get(categorieId);
    } else {
      categorie = (await categories.getCategorieById(categorieId))?.name;
      this.categorieCache.set(categorieId, categorie);
    }
    book["categorie"] = categorie;

    // Link
    book["link"] = "/book/" + encodeURI(book["title"]) + "-" + book["id"];

    // Poster
    book['poster'] = book["have_picture"] ? "/books/" + book["id"] + "/couverture.jpg" : "/books/default/" + categorie + ".png";
    
    return book;
  }

  // Récupérer tous les livres
  async getBooks(categorie) {
    try {
      let sql = 'SELECT * FROM books ORDER BY title ASC'
      let params = []

      if (categorie) {
        const categorieId = (await categories.getCategorieIdByName(categorie))?.id;
        if (categorieId) {
          sql = 'SELECT * FROM books WHERE categorie = ? ORDER BY title ASC'
          params = [categorieId]
        }
      }
      const [rows] = await pool.query(sql, params);

      for (const book of rows) {
        const processed = await this.book_process(book);
        book.title = processed.title;
      }

      return rows;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  // Récupérer un livre par ID
  async getBookById(id) {
    try {
      const [rows] = await pool.query('SELECT * FROM books WHERE id = ?', [id]);
      return rows[0] || null;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }
}

module.exports = new BookService(pool);