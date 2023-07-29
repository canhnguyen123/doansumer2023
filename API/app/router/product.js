const express = require('express');
const router = express.Router();
const productController= require('../controller/productController');

router.get('/', productController.getAllProduct);
router.get('/listcase', productController.getListCase);
router.get('/case/:theloai_id', productController.getdeatilCase);
router.get('/deatil/:product_id',productController.getDeatil);
router.get('/deatil-relate-to/:product_id/:theloai_id',productController.getrelate);
module.exports = router;
