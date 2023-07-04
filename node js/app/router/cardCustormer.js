const express = require('express');
const router = express.Router();
const custormerController = require('../controller/custormerController');

router.post('/add/:user_id', custormerController.getCardCustormer);
router.post('/update/:customerCart_id', custormerController.updateCardCustormer);
router.get('/mycard/:user_id', custormerController.getListCard)
router.get('/deleteCard/:customerCart_id',custormerController.deleteCard);
module.exports = router;
