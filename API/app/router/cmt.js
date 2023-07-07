const express = require('express');
const router = express.Router();
const cmtController = require('../controller/cmtController');

router.get('/list/:product_id', cmtController.getListCmt);
router.post('/add/:product_id/:user_id', cmtController.postCmt);

module.exports = router;
