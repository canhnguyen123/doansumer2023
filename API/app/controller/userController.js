const unidecode = require('unidecode');
const connection = require('../config/connection');
const Validator = require('../validate/userValidate');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { use } = require('../router/user');
const secretKey = 'yourSecretKey';
exports.getAllUsers = (req, res) => {
  connection.query('SELECT * FROM tbl_users', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    res.json(results);
  });
};
const bcrypt = require('bcrypt');

exports.createUser = (req, res) => {
  const phone = req.body.phone;
  const pass = req.body.password;
  const fullname = req.body.fullname;
  var check = true;
  const data = {}; // Định nghĩa biến data
  const createdAt = new Date(); // Define the createdAt variable with the current date
  data.created_at = createdAt;
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
      return res.json({ status: 'fall', errorPosition: "phone", mess: 'Số điện thoại này đã tồn tại, mời dùng số khác' });
      check = false;
    }

    if (check) {
      bcrypt.hash(pass, 10, (err, hashedPassword) => {
        if (err) {
          console.error('Lỗi mã hóa mật khẩu: ' + err);
          return res.status(500).json({ error: 'Lỗi mã hóa mật khẩu' });
        }

        const user = { user_fullname: fullname, user_phone: phone, user_password: hashedPassword, user_gender: 2, user_accountCategory: 1, created_at: new Date() };
        connection.query('INSERT INTO tbl_users SET ?', user, (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }

          return res.json({ status: 'success', mess: 'Thêm dữ liệu thành công' });
        });
      });
    }
  });
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

    if (results.length <= 0 || results[0].user_phone !== phone) {
      return res.json({ status: 'fall', errorPosition: "phone", mess: 'Số điện thoại này không tồn tại, mời nhập lại' });
    } else {
      if (results.length === 1) {
        const pass_user = results[0].user_password;
        bcrypt.compare(pass, pass_user, (err, result) => {
          if (err) {
            console.error('Lỗi so sánh mật khẩu: ' + err);
            return res.status(500).json({ error: 'Lỗi so sánh mật khẩu' });
          }
          if (result) {
            // Đăng nhập thành công
            const information_user = {
              user_id: results[0].user_id,
              user_phone: results[0].user_phone,
              user_fullname: results[0].user_fullname,
              user_email: results[0].user_email,
              user_gender: results[0].user_gender,
              user_address: results[0].user_address
            };
            const token = jwt.sign(information_user, secretKey, { expiresIn: '1h' });
            return res.json({ status: 'success', mess: 'Đăng nhập thành công',token: token ,information_user: information_user });
          } else {
            return res.json({ status: 'fall', errorPosition: "password", mess: 'Sai mật khẩu, mời nhập lại' });
          }
        });
      }
    }
  });
};


exports.update = (req, res) => {
  const user_id = req.params.user_id;
  const user_fullname=req.body.user_fullname;
  const user_address=req.body.user_address;
  const user_gender=req.body.user_gender;//truyền trạng thái 0 1 hoặc 2
  const user_email=req.body.user_email;
  const arr={user_fullname:user_fullname,user_address:user_address,user_gender:user_gender,user_email:user_email}
  connection.query('UPDATE tbl_users SET ? WHERE ?', [arr, { user_id: user_id }], (error, results) => {
     if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    if (results.affectedRows > 0) {
      const information_user = {
        user_id: user_id,
        user_fullname: user_fullname,
        user_email: user_email,
        user_gender: user_gender,
        user_address: user_address
      };
      return res.json({ status: 'success',  mess: 'Cập nhật thành công', information_user: information_user });
    } else {
      return res.json({ status: 'fail', mess: 'Không tìm thấy người dùng' });
    }
    
  })
}


exports.updatePassword = (req, res) => {
  const user_id = req.params.user_id;
  const user_password = req.body.user_password;
  const user_passwordNew = req.body.user_passwordNew;

  // Retrieve the user from the database
  connection.query('SELECT * FROM tbl_users WHERE ?', { user_id: user_id }, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }

    if (results.length === 0) {
      // User not found
      return res.status(404).json({ error: 'Người dùng không tồn tại' });
    }

    const user = results[0];

    // Compare the provided password with the stored hashed password
    bcrypt.compare(user_password, user.user_password, (error, isMatch) => {
      if (error) {
        console.error('Lỗi so sánh mật khẩu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi so sánh mật khẩu' });
      }

      if (!isMatch) {
        // Provided password does not match the stored password
        return res.json({status: "fall",errorPosition:"oldpasss" , mess: 'Mật khẩu cũ không chính xác' });
      }

      // Hash the new password
      bcrypt.hash(user_passwordNew, 10, (error, hashedPassword) => {
        if (error) {
          console.error('Lỗi mã hóa mật khẩu mới: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi mã hóa mật khẩu mới' });
        }

        // Update the user's password with the new hashed password
        connection.query('UPDATE tbl_users SET user_password = ? WHERE ?', [hashedPassword, { user_id: user_id }], (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }

          return res.json({ status: "success",mess: 'Mật khẩu đã được cập nhật thành công' });
        });
      });
    });
  });
};
exports.checkPhone = (req, res) => {
  const phone = req.body.user_phone;
  connection.query("SELECT * FROM tbl_users WHERE user_phone = ?", [phone], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    if (results.length > 0) {
      return res.json({ status: 'success', mess: 'có tài khoản này' });
    } else {
      return res.json({ status: 'fall', mess: 'Không tìm thấy tài khoản này' });
    }
  });
}

exports.forgetPass = (req, res) => {
  const user_id = req.params.user_id;
  const user_password = req.body.user_password;


  // Retrieve the user from the database
  connection.query('SELECT * FROM tbl_users WHERE ?', { user_id: user_id }, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }

    if (results.length === 0) {
      // User not found
      return res.json({ status: 'fall', mess: 'Không tìm thấy tài khoản này' });
    }

    const user = results[0];

    // Compare the provided password with the stored hashed password
    bcrypt.compare(user_password, user.user_password, (error, isMatch) => {
      if (error) {
        console.error('Lỗi so sánh mật khẩu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi so sánh mật khẩu' });
      }
      
      bcrypt.hash(user_passwordNew, 10, (error, hashedPassword) => {
        if (error) {
          console.error('Lỗi mã hóa mật khẩu mới: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi mã hóa mật khẩu mới' });
        }

        // Update the user's password with the new hashed password
          connection.query('UPDATE tbl_users SET user_password = ? WHERE ?', [hashedPassword, { user_id: user_id }], (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }

          return res.json({ status: "success",mess: 'Mật khẩu đã được cập nhật thành công' });
        });
      });
    });
  });
}
