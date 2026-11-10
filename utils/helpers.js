module.exports = {
  startswithAVoyelle: (str) => {
    return /^[aeiouhàâäéèêëïîôùûü]/i.test(str);
  },
};