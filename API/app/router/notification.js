const express = require('express');
const router = express.Router();
const notificationController = require('../controller/notificationController');

router.get('/notication-Unread/:user_id', notificationController.getNoticationUnread);
router.get('/notication-Readed/:user_id', notificationController.getNoticationReaded);
router.get('/notication-update-status-all/:mess_id', notificationController.noticationUpdateStatus);
router.get('/notication-update-status/:user_id', notificationController.noticationUpdateStatusALl);
module.exports = router;
