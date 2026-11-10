// services/users.js
const pool = require('../config/database');
const bcrypt = require('bcryptjs');

module.exports = {
  findByEmail: async (email) => {
    const [rows] = await pool.query('SELECT * FROM users WHERE email = ?', [email]);
    return rows[0];
  },

  findByUsername: async (username) => {
    const [rows] = await pool.query('SELECT * FROM users WHERE username = ?', [username]);
    return rows[0];
  },

  findById: async (id) => {
    const [rows] = await pool.query('SELECT * FROM users WHERE id = ?', [id]);
    return rows[0];
  },

  verifyPassword: async (plain, hash) => {
    return bcrypt.compare(plain, hash);
  },

  create: async (username, first_name, last_name, email, password) => {
    const hash = await bcrypt.hash(password, 10);
    const [result] = await pool.query(
      'INSERT INTO users (username, password, first_name, last_name, email, is_admin, biographie) VALUES (?, ?, ?, ?, ?, 0, \'\')',
      [username, hash, first_name, last_name, email]
    );
    return result.insertId;
  },
};