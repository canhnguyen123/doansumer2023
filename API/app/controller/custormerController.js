const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
const moment = require('moment');

exports.getCardCustormer = (req, res, user_id) => {
  const user_id_ = req.params.user_id;
  const product_id = req.body.product_id;
  const card_quantity = req.body.card_quantity;
  const card_size = req.body.card_size;
  const card_color = req.body.card_color;
  const createdAt = moment();
  const data = {}; // Định nghĩa biến data
  data.created_at = createdAt;
  const cardCustormer = {
     user_id: user_id_, 
     product_id: product_id,
     card_quantity:card_quantity,
     card_size:card_size,
     card_color:card_color,
     created_at: new Date() };
  connection.query('INSERT INTO customer_cart SET ?', cardCustormer, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    res.json({ status: 'success', mess: 'Thêm dữ liệu thành công' });
  });
};
exports.updateCardCustormer = (req, res) => {
  const customerCart_id = req.params.customerCart_id;
  const card_quantity = req.body.card_quantity;
  const cardCustormer = { card_quantity: card_quantity };
  const whereCardId = { customerCart_id: customerCart_id };
  connection.query('UPDATE customer_cart SET ? WHERE ?', [cardCustormer, whereCardId], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    res.json({ status: 'success', mess: 'Thêm dữ liệu thành công' });
  });
};
exports.getListCard = (req, res, user_id) => {
  const user_id_ = req.params.user_id;
  const getCard = { user_id: user_id_ };
  connection.query('SELECT * FROM customer_cart WHERE ?', getCard, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const productIds = [];
    // Duyệt qua kết quả và lấy ra product_id
    for (let i = 0; i < results.length; i++) {
      const product_id = results[i].product_id;
      const customerCart_id = results[i].customerCart_id;
      const card_quantity = results[i].card_quantity;
      const card_size = results[i].card_size;
      const card_color = results[i].card_color;
      productIds.push(product_id);
    }

    // Truy vấn thông tin từ bảng tbl_product dựa trên productIds
    const sql = 'SELECT * FROM tbl_product WHERE product_id IN (?)';
    connection.query(sql, [productIds], (error, productResults) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }

      const products = [];
      // Duyệt qua kết quả và tạo đối tượng sản phẩm tương ứng
      for (let i = 0; i < productResults.length; i++) {
        const product = {
          product_id: productResults[i].product_id,
          product_name: productResults[i].product_name,
          product_price: productResults[i].product_price,
          customerCart_id: '' ,
          customerCart_quantity: '' ,
        };

        // Truy vấn ảnh mới nhất từ bảng tbl_list_img__product
        const imgSql = 'SELECT * FROM tbl_list_img__product WHERE product_id = ? ORDER BY img_id  DESC LIMIT 1';
        connection.query(imgSql, [productResults[i].product_id], (error, imgResults) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }

          // Kiểm tra nếu có ảnh mới nhất, thì gán vào thuộc tính của sản phẩm
          if (imgResults.length > 0) {
            product.latest_image = imgResults[0].img_name;
          }
          product.customerCart_id = results[i].customerCart_id;
          product.customerCart_quantity = results[i].card_quantity;
          // Đẩy sản phẩm vào mảng products
          products.push(product);

          // Kiểm tra nếu đã duyệt qua tất cả sản phẩm, thì trả về kết quả
          if (products.length === productResults.length) {
            res.json({ status: 'success', results: products });
          }
        });
      }
    });
  });
};
exports.deleteCard = (req, res, customerCart_id) => {
  const customerCart_id_ = req.params.customerCart_id;

  const cardCustormer = { customerCart_id: customerCart_id_};
  connection.query('DELETE FROM  customer_cart WHERE ?', cardCustormer, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    res.json({ status: 'success', mess: 'Xóa dữ liệu thành công' });
  });
}






