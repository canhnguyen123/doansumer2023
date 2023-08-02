const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
exports.getNoticationUnread = (req, res) => {
  var user_id= req.params.user_id;
  connection.query('SELECT * FROM tbl_mess WHERE user_id=? AND mess_status=1', [user_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    const arr = results.map((item) => {
      return {
        mess_id: item.mess_id,
        mess_category: item.mess_category,
        mess_content: item.mess_content,
        mess_status: item.mess_status,
        created_at: item.created_at
      };
    });

    return res.json({ status: 'success', results: arr });
  });
};

exports.getNoticationReaded = (req, res) => {
  var user_id= req.params.user_id;
  connection.query('SELECT *FROM tbl_mess WHERE user_id=? AND mess_status=0',[user_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr=results.map((item)=>{
      return {
        mess_id: item.mess_id,
      mess_category:item.mess_category,
      mess_content:item.mess_content,
      mess_status:item.mess_status,
      created_at:item.created_at
      }
    })
    return res.json({status:'success',results:arr})
 })
}

exports.noticationUpdateStatus = (req, res) => {
  var mess_id= req.params.mess_id;
  connection.query('UPDATE tbl_mess SET  mess_status=0  WHERE mess_id=? ',[mess_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    return res.json({status:'success',mess:"Đã đọc"})
 })
}

exports.noticationUpdateStatusALl = (req, res) => {
  var user_id= req.params.user_id;
  connection.query('UPDATE tbl_mess SET  mess_status=0  WHERE user_id=? ',[user_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    return res.json({status:'success',mess:"Đã đọc"})
 })
}
