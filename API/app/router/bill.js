const express = require('express');
const router = express.Router();
const billController = require('../controller/billController');

router.post('/add/:user_id', billController.postbill);
router.get('/update-status-payment/:hoadon_id', billController.updateSuccessBill);
router.get('/get-category-payment/', billController.selectCategorypayment);
router.get('/get-voucher', billController.getlistvoucher);
router.get('/get-my-bill/:user_id/:status_payment', billController.getmybill);
router.get('/get-my-bill-deatil/:hoadon_id', billController.getdeatilPayment);
router.get('/get-my-bill-history/:user_id', billController.getmybillHistory);
module.exports = router;
