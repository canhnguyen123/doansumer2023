const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');
const unidecode = require('unidecode');
const userRouter = require('./router/user');
const productRouter = require('./router/product');
const bannerRouter = require('./router/banner');
const custormerRouter = require('./router/cardCustormer');
const billRouter = require('./router/bill');
const cmtRouter = require('./router/cmt');
const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors());

app.use('/user', userRouter);
app.use('/product',productRouter);
app.use('/banner',bannerRouter);
app.use('/custormer',custormerRouter);
app.use('/bill',billRouter);
app.use('/cmt',cmtRouter);

app.listen(4000, () => {
  console.log('Server đang lắng nghe tại cổng 4000');
});
