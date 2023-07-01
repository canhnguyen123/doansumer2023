const express = require('express');
const router = express.Router();
const billController = require('../controller/billController');

router.post('/add/:user_id', billController.postbill);

module.exports = router;
