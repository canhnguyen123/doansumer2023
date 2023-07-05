const express = require('express');
const router = express.Router();
const bannerController = require('../controller/bannerController');

router.get('/', bannerController.getAllBanner);


module.exports = router;
