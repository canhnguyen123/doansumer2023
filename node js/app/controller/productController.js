const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
exports.getAllProduct = (req, res) => {
  const Promise = require('bluebird'); // Import Promise library (for example, Bluebird)

  connection.query('SELECT * FROM tbl_theloai WHERE show_home = 1 AND theloai_status = 1', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
  
    const theloaiList = results.map((row) => {
      const theloai_id = row.theloai_id;
      const theloai_name = row.theloai_name;
      const queryPromise = new Promise((resolve, reject) => {
        connection.query('SELECT * FROM tbl_product WHERE product_status = 1 AND theloai_id = ? ORDER BY product_id DESC LIMIT 3', theloai_id, (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            reject(error);
          } else {
            resolve(results);
          }
        });
      });
  
      return queryPromise.then((productResults) => {
        const listProductPromises = productResults.map((product) => {
          return new Promise((resolve, reject) => {
            connection.query('SELECT * FROM tbl_list_img__product WHERE product_id = ? ORDER BY img_id DESC LIMIT 1', product.product_id, (error, imgResults) => {
              if (error) {
                console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
                reject(error);
              } else {
                const productImg = imgResults[0];
                const listImg =productImg.img_name ;
                const productData = {
                  product_id: product.product_id,
                  product_name: product.product_name,
                  product_price: product.product_price,
                  img_url:  listImg
                };
                resolve(productData);
              }
            });
          });
        });
  
        return Promise.all(listProductPromises)
          .then((listProduct) => {
            return {
              theloai_id: theloai_id,
              theloai_name: theloai_name,
              list_product: listProduct
            };
          })
          .catch((error) => {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            reject(error);
          });
      });
    });
  
    Promise.all(theloaiList)
      .then((finalResults) => {
        const response = { status: 'success',results: finalResults};
        return res.json(response);
      })
      .catch((error) => {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      });
  });
  
};
