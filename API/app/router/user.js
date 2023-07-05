const express = require('express');
const router = express.Router();
const userController = require('../controller/userController');

router.get('/', userController.getAllUsers);
router.post('/dangki', userController.createUser);
router.post('/login', userController.login);

module.exports = router;
