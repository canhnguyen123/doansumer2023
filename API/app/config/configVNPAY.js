const vnp_TmnCode = "WTOYWYNC"; // Mã website trong hệ thống VNPAY
const vnp_HashSecret = "OVKXBXCQODKJPOQHITIWRHPZRATOGHAR"; // Khóa bí mật
const vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
const vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
const vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
const startTime = new Date();
const expire = new Date(startTime.getTime() + 15 * 60000); // Hết hạn sau 15 phút

module.exports = {
  vnp_TmnCode,
  vnp_HashSecret,
  vnp_Url,
  vnp_Returnurl,
  vnp_apiUrl,
  startTime,
  expire,
};
