const express = require('express');
const router = express.Router();
const userController = require('../controller/userController');

router.get('/', userController.getAllUsers);
router.post('/dangki', userController.createUser);
router.post('/login', userController.login);
router.post('/update-user/:user_id', userController.update);
router.post('/update-password/:user_id', userController.updatePassword);
module.exports = router;
