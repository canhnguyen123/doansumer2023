const express = require('express');
const router = express.Router();
const userController = require('../controller/userController');

router.get('/list', userController.getAllUsers);
router.post('/post', userController.createUser);


module.exports = router;
