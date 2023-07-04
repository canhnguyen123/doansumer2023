const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
const moment = require('moment');
exports.postbill = (req, res) => {
  const user_id=req.params.user_id;
  const hoadon_allprice=req.body.hoadon_allprice;
  const vocher_id=req.body.vocher_id; 
  const is_voucher=req.body.is_voucher;
  const category_payment_id=req.body.category_payment_id; 
  const hoadon_address=req.body.hoadon_address;
  const hoadon_deatil=JSON.parse(req.body.hoadon_deatil);
  const createdAt = moment();
  const data = {}; // Định nghĩa biến data
  data.created_at = createdAt;
  const arr={user_id:user_id,hoadon_code:"",category_payment_id:category_payment_id,hoadon_allprice:hoadon_allprice,status_payment_id:1,vocher_id:vocher_id,is_voucher:is_voucher,hoadon_address:hoadon_address,created_at:new Date() }
  connection.query("INSERT INTO tbl_hoadon SET ?",[arr],(error,results)=>{
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const hoadonId = results.insertId; // Lấy ra hoadon_id của dữ liệu vừa thêm
    hoadon_deatil.forEach(item => {
        const arrDeatil={hoadon_id:hoadonId, product_id:item[0],hoadondeatil_quantyti:item[1], hoadon_size:item[2],hoadon_color:item[3]}
      connection.query("INSERT INTO tbl_hoadon_deatil SET ?",[arrDeatil],(error,results)=>{
        if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        }
      } )
      });

    return res.json({status: 'success', mess: 'Cảm ơn bạn đã mua hàng của chúng tôi đơn hàng của bạn sẽ được duyệt trong giời gian sớm nhất',
   });
  })
};
exports.updateSuccessBill = (req, res) => {
  const hoadon_id = req.params.hoadon_id;
const arr = { status_payment_id: 4 };
const dk = { hoadon_id: hoadon_id };
connection.query(
  "UPDATE tbl_hoadon SET ? WHERE ?",
  [arr, dk],
  (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    return res.json({
      status: 'success',
      mess: 'Cảm ơn bạn đã mua hàng của chúng tôi đơn hàng của bạn sẽ được duyệt trong giời gian sớm nhất',
    });
  }
);
};