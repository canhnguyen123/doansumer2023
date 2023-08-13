const express = require('express');
const router = express.Router();
const billController = require('../controller/billController');

router.post('/add/:user_id', billController.postbill);/// tạo hóa đơn
///cập nhật trạng thái là đã giao hàng thành công
router.get('/update-status-payment/:hoadon_id', billController.updateSuccessBill);
/// lấy danh sách thể loại thanh toán
router.get('/get-category-payment/', billController.selectCategorypayment);
// lấy  danh sách mã voucher
router.get('/get-voucher', billController.getlistvoucher);
/// đếm ra số đơn hàng theo trạng thái
router.get('/count-my-bill/:user_id/:status_payment', billController.getmybill);
//lấy ra danh sách hóa đơn từng trạng thái
router.get('/getlist-my-bill/:user_id/:status_payment', billController.getlistbill);
/// xem chi tiết đơn hàng
router.get('/get-my-bill-deatil/:hoadon_id', billController.getdeatilPayment);
//// lấy ra lịch sửa mua hàng
router.get('/get-my-bill-history/:user_id', billController.getmybillHistory);
module.exports = router;
