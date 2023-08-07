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

  connection.query(
    `
    SELECT tbl_commet.*, tbl_users.user_fullname, tbl_users.user_img
    FROM tbl_commet
    LEFT JOIN tbl_users ON tbl_commet.user_id = tbl_users.user_id
    WHERE tbl_commet.product_id = ? AND tbl_commet.mess_parent_comment_id IS NULL
    `,
    [product_id],
    (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
      
      const arr = []; // Khai báo mảng ngoài vòng lặp để lưu trữ thông tin của tất cả các comment
      results.forEach(item => {
        var check_account = "";
        var img = "";
        var name="";
        if (item.user_id === null) {
          check_account = "Quản trị viên";
          img = "https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/2304226.png?alt=media&token=344cb26d-7070-48a9-b8bd-b6646030858c";
          name="Quán trị viên";
        } else if (item.staff_id === null) {
          check_account = "Người dùng";
          name=item.user_fullname;
          if (item.user_img === "") {
            img = "https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/c6e56503cfdd87da299f72dc416023d4.jpg?alt=media&token=0f06f1ca-d5a1-48e8-a8e7-704fdca9f927";
           
          } else {
            img = item.user_img;
          }
        }
        
        const commentInfo = {
          cmt_id: item.cmt_id,
          user_id: item.user_id,
          check_account: check_account,
          mess_parent_comment_id: item.mess_parent_comment_id,
          user_img: img,
          name: name,
          cmt_text: item.cmt_text,
          created_at: item.created_at,
        };
        arr.push(commentInfo); // Thêm thông tin của từng comment vào mảng arr
      });

      return res.json({ status: 'success', listCmt: arr });
    }
  );
};


exports.postCmt = (req, res) => {

  const product_id = req.params.product_id;
  const user_id = req.params.user_id;
  const cmt_context = req.body.cmt_context;
  const mess_parent_comment_id = req.body.mess_parent_comment_id;
  const arrlist={product_id:product_id,user_id:user_id,mess_parent_comment_id:mess_parent_comment_id,cmt_text:cmt_context,created_at:new Date()};
  connection.query("INSERT INTO tbl_commet SET ?",arrlist,(error, results)=>{
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    return res.json({status:"success",mess:"Đã thêm bình luận"});
  })
}

