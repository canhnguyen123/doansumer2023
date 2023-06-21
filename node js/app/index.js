const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');
const unidecode = require('unidecode');
const userRouter = require('./router/user');
const productRouter = require('./router/product');
const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cors());
app.use('/user', userRouter);
app.use('/product',productRouter);

app.listen(4000, () => {
  console.log('Server đang lắng nghe tại cổng 4000');
});
