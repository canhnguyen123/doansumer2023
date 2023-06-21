const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
exports.getAllProduct = (req, res) => {
  var arr = [
    { name: 'John', age: 25 },
    { name: 'Jane', age: 30 },
    { name: 'David', age: 40 }
  ];
  connection.query('SELECT * FROM tbl_theloai WHERE show_home= 1 AND theloai_status=1', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
  
    const theloaiList = results.map((row) => {
      return {
        theloai_id: row.theloai_id,
        ten_theloai: arr
      };
    });
  
    return res.json({status:"success", results:theloaiList});
  });
  

};
