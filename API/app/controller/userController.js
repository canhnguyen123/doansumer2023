const unidecode = require('unidecode');
const connection = require('../config/connection');
const Validator = require('../validate/userValidate');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
exports.getAllUsers = (req, res) => {
  connection.query('SELECT * FROM tbl_users', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    res.json(results);
  });
};
exports.createUser = (req, res) => {
  const phone = req.body.phone;
  const pass = req.body.password;
  const fullname = req.body.fullname;
  var check = true;

  const validation = Validator.validateUser(phone, pass, fullname);
  if (validation.status === 'fall') {
    return res.json(validation);
    check = false;
  }

  
    const user = { user_phone: phone };
    connection.query('SELECT * FROM tbl_users WHERE ?', user, (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }

      if (results.length > 0) {
        return res.json({ status: 'fall', errorPosition: "phone", mess: 'Số điện thoại này đã tồn tại  mời dùng số khác' });
        check=false;
      }

    });
    
    if (check) {
      const token = uuidv4();
      const user = { user_fullname: fullname, user_phone: phone, user_password: pass,user_gender:2,user_token:token };
      connection.query('INSERT INTO tbl_users SET ?', user, (error, results) => {
        if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        }

        return res.json({ status: 'success', mess: 'Thêm dữ liệu thành công' });
      });
    }
};
exports.login = (req, res) => {
  const phone = req.body.phone;
  const pass = req.body.password;
  var check = true;
  const user = { user_phone: phone };
  connection.query('SELECT * FROM tbl_users WHERE ?', user, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }

    if (results.length <= 0|| results[0].user_phone !== phone) {
      return res.json({ status: 'fall', errorPosition: "phone", mess: 'Số điện thoại này không tồn tại, mời nhập lại' });
    } else {
      if (results.length === 1) {
        const pass_user = results[0].user_password;
        if (pass === pass_user) {
          // Đăng nhập thành công
          const information_user = {
            user_id: results[0].user_id,
            user_phone: results[0].user_phone,
            user_fullname: results[0].user_fullname,
            user_token: results[0].user_token,
            user_email: results[0].user_email,
            user_gender: results[0].user_gender,
            user_address: results[0].user_address
          };
          return res.json({ status: 'success', mess: 'Đăng nhập thành công', information_user: information_user });
        } else {
          return res.json({ status: 'fall', errorPosition: "password", mess: 'Sai mật khẩu, mời nhập lại' });
        }
      }
    }
  });
};

