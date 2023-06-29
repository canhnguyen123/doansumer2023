const express = require('express');
const router = express.Router();
const productController= require('../controller/productController');

router.get('/', productController.getAllProduct);
router.get('/listcase', productController.getListCase);
router.get('/case/:theloai_id', productController.getdeatilCase);
router.get('/deatil/:product_id',productController.getDeatil);
module.exports = router;
