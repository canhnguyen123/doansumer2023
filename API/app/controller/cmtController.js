const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
exports.getListCmt = (req, res) => {
  const product_id = req.params.product_id;
  const arrPro = { product_id: product_id };
  const arr = [];
  
  connection.query("SELECT * FROM tbl_commet WHERE ?", arrPro, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    results.forEach(item => {
      const user_id = item.user_id;
      const arrUser = { user_id: user_id };
      
      connection.query("SELECT * FROM tbl_users WHERE ?", arrUser, (error, userResults) => {
        if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        }
        
        const user = userResults[0]; // Lấy kết quả đầu tiên từ truy vấn tbl_user
        
        const arrlist = {
          cmt_id: item.cmt_id,
          cmt_text: item.cmt_text,
           user_id: user.user_id,
          user_fullname: user.user_fullname,
          user_img: user.user_img,
          created_at: item.created_at,
        };
        
        arr.push(arrlist);
        
        if (arr.length === results.length) {
          return res.json({ status: 'success', listCmt: arr });
        }
      });
    });
  });
};

exports.postCmt = (req, res) => {

  const product_id = req.params.product_id;
  const user_id = req.params.user_id;
  const cmt_context = req.body.cmt_context;
  const arrlist={product_id:product_id,user_id:user_id,cmt_text:cmt_context,created_at:new Date()};
  connection.query("INSERT INTO tbl_commet SET ?",arrlist,(error, results)=>{
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    return res.json({status:"success",mess:"Đã thêm bình luận"});
  })
}

