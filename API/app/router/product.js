const express = require('express');
const router = express.Router();
const productController= require('../controller/productController');

router.get('/', productController.getAllProduct);
router.get('/listcase', productController.getListCase);
router.get('/case/:theloai_id', productController.getdeatilCase);
router.get('/deatil/:product_id',productController.getDeatil);
router.get('/select-all-product/',productController.getAll);
router.get('/select-all-color/',productController.getColor);
router.get('/select-all-size/',productController.getSize);
router.get('/select-all-category/',productController.getCateory);
router.get('/select-all-phanloai/',productController.getPhanloai);
router.post('/select-all-theloai/',productController.getTheloai);
router.get('/deatil-relate-to/:product_id/:theloai_id',productController.getrelate);
module.exports = router;
