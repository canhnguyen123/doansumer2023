const express = require('express');
const router = express.Router();
const billController = require('../controller/billController');

router.post('/add/:user_id', billController.postbill);
router.get('/update-status-payment/:hoadon_id', billController.updateSuccessBill);
module.exports = router;
