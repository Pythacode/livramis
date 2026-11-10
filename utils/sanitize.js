const sanitizeHtml = require('sanitize-html');

const allowedTags = [
  'p', 'span', 'strong', 'em', 'u', 's', 'blockquote',
  'a', 'div', 'br', 'pre', 'ol', 'ul', 'li',
];

module.exports = (html) => sanitizeHtml(html, {
  allowedTags,
  allowedAttributes: {
    a: ['href', 'title', 'target', 'rel'],
    span: ['class'],
  },
  allowedSchemes: ['http', 'https', 'mailto', 'tel'],
});