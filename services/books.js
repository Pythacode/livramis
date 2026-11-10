const categories = require('./categories')
const authors = require('./author')
const pool = require('../config/database');

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
    book["link"] = "/book/" + book["slug"];// + "-" + book["id"];

    // Poster
    book['poster'] = book["have_picture"] ? `/books/couverture_${book.id}.jpg` : "/books/default/" + categorie + ".png";

    book['author'] = authors.getAuthorById(book['author_id'])

    return book;
  }

  async getBooks(categorie) {
    try {
      let sql = `SELECT b.*, a.name AS author_name
        FROM books b
        LEFT JOIN authors a ON a.id = b.author_id
        ORDER BY b.title ASC
      `
      let params = []

      if (categorie) {
        const categorieId = (await categories.getCategorieIdByName(categorie))?.id;
        if (categorieId) {
          sql = `
            SELECT b.*, a.name AS author_name
            FROM books b
            LEFT JOIN authors a ON a.id = b.author_id
            WHERE b.categorie = ?
            ORDER BY b.title ASC
          `
          params = [categorieId]
        }
      }
      const [rows] = await pool.query(sql, params);

      for (const book of rows) {
        await this.book_process(book);
      }

      return rows;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  async getBookByProprietaire(id) {
    try {
      const [rows] = await pool.query(`SELECT b.*, a.name AS author_name
            FROM books b
            LEFT JOIN authors a ON a.id = b.author_id
            WHERE user_id = ?`, [id]);
      for (const book of rows) {
        await this.book_process(book);
      }
      return rows;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  async getBookByTitle(id) {
    try {
      const [rows] = await pool.query(
            `SELECT b.*, a.name AS author_name
            FROM books b
            LEFT JOIN authors a ON a.id = b.author_id
            WHERE title = ?`,
            [id]
      );
      for (const book of rows) {
        await this.book_process(book);
      }
      return rows[0] || null;
    } catch (err) {
      console.error('Error:', err);
      throw err;
    }
  }

  async addBook(title, resume, author, user_id, have_picture, categorie, slug) {
    try {
        const [result] = await pool.query(
          'INSERT INTO books (title, synopsis, state, author_id, user_id, have_picture, categorie, slug) VALUES (?, ?, "Disponible", ?, ?, ?, ?, ?)',
          [title, resume, author, user_id, have_picture, categorie, slug]
        );
        return result.insertId;
    } catch (error) {
        console.error(error);
        throw error;
    }
  }

  async getBookBySlug(slug) {
    const [rows] = await pool.query(
      `SELECT b.*, a.name AS author_name
      FROM books b
      LEFT JOIN authors a ON a.id = b.author_id
      WHERE b.slug = ?`,
      [slug]
    );
    if (!rows[0]) return null;
    this.book_process(rows[0])
    return rows[0] ?? null;
  }

  async bookExists(slug) {
    const [rows] = await pool.query('SELECT 1 FROM books WHERE slug = ? LIMIT 1', [slug]);
    return rows.length > 0;
  }

  async generateUniqueSlug(title) {
    const base = slugify(title);
    let slug = base;
    let i = 1;
    while (await bookExists(slug)) {
      slug = `${base}-${i++}`;
    }
    return slug;
  }
}

module.exports = new BookService(pool);