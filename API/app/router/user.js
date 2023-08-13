const express = require('express');
const router = express.Router();
const userController = require('../controller/userController');

router.get('/', userController.getAllUsers);//
router.post('/dangki', userController.createUser);// đăng kí
router.post('/login', userController.login);// đăng nhập
/// cập nhật thông tin
router.put('/update-user/:user_id', userController.update);
// đổi mật khẩu
router.put('/update-password/:user_id', userController.updatePassword);
///quên mật khẩu
router.post('/check-phone', userController.checkPhone);//-> kiếm tra sđt trước
router.post('/forget-pass/:user_id', userController.forgetPass);// nếu có mới cho đổi Mk

module.exports = router;
