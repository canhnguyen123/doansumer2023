const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
exports.getAllBanner = (req, res) => {
  const arr_Banner=[];
  connection.query('SELECT*FROM  tbl_banner WHERE  banner_status=1  ORDER BY banner_id  DESC LIMIT 5', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    results.forEach((row) => {
    const banner_link = row.banner_link;
      const formattedResult = {
       
        banner_link: banner_link
      };
      arr_Banner.push(formattedResult);
    });
    results = arr_Banner;
    res.json(results);
  });
};
