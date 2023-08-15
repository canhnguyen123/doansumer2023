const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
const { json } = require('body-parser');
const moment = require("moment");
exports.postbill = (req, res) => {
  const user_id=req.params.user_id;
  const hoadon_allprice=req.body.hoadon_allprice;
  const vocher_id=req.body.vocher_id; 
  const is_voucher=req.body.is_voucher;
  const category_payment_id=req.body.category_payment_id; 
  const hoadon_address=req.body.hoadon_address;
  const hoadon_deatil=JSON.parse(req.body.hoadon_deatil);
  const createdAt = moment();
  const data = {}; // Định nghĩa biến data
  data.created_at = createdAt;
  const arr={user_id:user_id,hoadon_code:"",category_payment_id:category_payment_id,hoadon_allprice:hoadon_allprice,status_payment_id:1,vocher_id:vocher_id,is_voucher:is_voucher,hoadon_address:hoadon_address,created_at:new Date() }
  connection.query("INSERT INTO tbl_hoadon SET ?",[arr],(error,results)=>{
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const hoadonId = results.insertId; // Lấy ra hoadon_id của dữ liệu vừa thêm
    hoadon_deatil.forEach(item => {
        const arrDeatil={hoadon_id:hoadonId, product_id:item[0],hoadondeatil_quantyti:item[1], hoadon_size:item[2],hoadon_color:item[3]}
      connection.query("INSERT INTO tbl_hoadon_deatil SET ?",[arrDeatil],(error,results)=>{
        if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        }
      } )
      });

    return res.json({status: 'success', mess: 'Cảm ơn bạn đã mua hàng của chúng tôi đơn hàng của bạn sẽ được duyệt trong giời gian sớm nhất',
   });
  })
};
exports.updateSuccessBill = (req, res) => {
  const hoadon_id = req.params.hoadon_id;
  if(hoadon_id!==3){
    return res.json({status: 'fail', mess: 'Hóa đơn của bạn phải đang giao mới cập nhật lên đã nhận hàng',
  });
  }
  else{
    connection.query('SELECT *FROM tbl_hoadon  WHERE hoadon_id=?',[hoadon_id], (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
      const status_payment_id=results[0].status_payment_id;
    
        const arr = { status_payment_id: 4 };
        const dk = { hoadon_id: hoadon_id };
      
        connection.query('UPDATE tbl_hoadon SET ? WHERE ?', [arr, dk], (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }
      
          connection.query('SELECT * FROM tbl_hoadon_deatil WHERE hoadon_id = ?', [hoadon_id], (error, results1) => {
            if (error) {
              console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
              return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
            }
      
            results1.forEach((item) => {
              const product_id_detail = item.product_id;
              const quantyti = item.hoadondeatil_quantyti;
              const color = item.hoadon_color;
              const size = item.hoadon_size;
      
              connection.query('SELECT * FROM tbl_quantity_product WHERE product_id = ?', [product_id_detail], (error, results2) => {
                if (error) {
                  console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
                  return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
                }
      
                results2.forEach((item1) => {
                  const product_id_quantity = item1.product_id;
                  const quantity_old = item1.quantity_sl;
                  const quantityNew = quantity_old - quantyti;
      
                  connection.query(
                    'UPDATE tbl_quantity_product SET quantity_sl = ? WHERE product_id = ? AND quantity_color = ? AND quantity_size = ?',
                    [quantityNew, product_id_quantity, color, size],
                    (error, results3) => {
                      if (error) {
                        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
                        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
                      }
                    }
                  );
                });
              });
            });
          });
      
          return res.json({
            status: 'success',
            mess: 'Cảm ơn bạn đã mua hàng của chúng tôi, đơn hàng của bạn sẽ được duyệt trong thời gian sớm nhất',
          });
        });
    
    })
  }
  
 

};

exports.selectCategorypayment = (req, res) => {
  connection.query('SELECT * FROM tbl_category_payment WHERE category_payment_status=1', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    const arr = [];
    results.forEach((item) => {
      const arrList = {
        category_payment_id: item.category_payment_id,
        category_payment_name: item.category_payment_name,
      };
      arr.push(arrList);
    });

    return res.json({
      status: 'success',
      results: arr
    });
  });
};
exports.getlistvoucher = (req, res) => {
  connection.query('SELECT * FROM tbl_vocher WHERE voucher_status = 1', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }

    const arr = [];
    results.forEach((item) => {
      const Id = item.voucher_id;
      const category_payment_id = item.category_payment_id;
     
      if (Id !== 1) {
        connection.query('SELECT * FROM tbl_category_payment WHERE category_payment_status = 1 AND category_payment_id = ?', [category_payment_id], (error, results2) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
          }
          
          const name = results2[0].category_payment_name;

          const arrItem = {
            voucher_id: item.voucher_id,
            voucher_code: item.voucher_code,
            voucher_name: item.voucher_name,
            voucher_down: item.voucher_down,
            voucher_category: item.voucher_category,
            voucher_unit: item.voucher_unit,
            category_payment_id: item.category_payment_id,
            category_payment_name: name, // Thêm trường category_payment_name vào đối tượng arrItem
            voucher_start: moment(item.voucher_start).format("YYYY-MM-DD HH:mm:ss"),
            voucher_end: moment(item.voucher_end).format("YYYY-MM-DD HH:mm:ss"),
            voucher_limit: item.voucher_limit,
          };
          arr.push(arrItem);
          // Trả về kết quả dưới dạng JSON response
          return res.json({ status: "success", results: arr });
        });
      }
    });
  });
};
exports.getmybill = (req, res) => {
  var user_id = req.params.user_id;
  var status_payment = req.params.status_payment;
  
  if (status_payment > 6) {
    return res.json({ status: "fall", mess: "không tìm thấy có trạng thái nào" });
  }
  
  let query = 'SELECT * FROM tbl_hoadon WHERE user_id = ? AND status_payment_id = ?';
  let queryParams = [user_id, status_payment];

  if (status_payment === 4) {
    query = 'SELECT * FROM tbl_hoadon WHERE user_id = ? AND status_payment_id = ? LIMIT 3';
  }

  connection.query(query, queryParams, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    const count = results.length;
    // Trả về kết quả dưới dạng JSON response
    return res.json({ status: "success", results: count });
  });
}
exports.getlistbill = (req, res) => {
  var user_id = req.params.user_id;
  var status_payment = req.params.status_payment;
  var code="";
  if (status_payment > 6) {
    return res.json({ status: "fall", mess: "không tìm thấy có trạng thái nào" });
  }
  
  let query = 'SELECT * FROM tbl_hoadon WHERE user_id = ? AND status_payment_id = ?';
  let queryParams = [user_id, status_payment];

  if (status_payment === 4) {
    query = 'SELECT * FROM tbl_hoadon WHERE user_id = ? AND status_payment_id = ? LIMIT 3';
  }

  connection.query(query, queryParams, (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    const arr = results.map((item) => {
      if(item.hoadon_code===""){
        code="chưa tạo hóa đơn"
      }else{
        code=item.hoadon_code;
      }
      return {
        hoadon_id: item.hoadon_id,
        hoadon_code: code,
        hoadon_allprice: item.hoadon_allprice,
        created_at: item.created_at
      };
    });
    // Trả về kết quả dưới dạng JSON response
    return res.json({ status: "success", results: arr});
  });
}
exports.getmybillHistory = (req, res) => {
  var user_id = req.params.user_id;
  var code = "";

  connection.query('SELECT * FROM tbl_hoadon WHERE user_id = ? AND status_payment_id = 4', [user_id], (error, results) => {
      if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }

      const arr = [];
      results.forEach((item, index) => {
          var hoadon_id = item.hoadon_id;

          connection.query('SELECT COUNT(*) AS rowCount FROM tbl_hoadon_deatil WHERE hoadon_id = ?', [hoadon_id], (error, countResults) => {
              if (error) {
                  console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
                  return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
              }

              const rowCount = countResults[0].rowCount; // Lấy kết quả đếm từ kết quả truy vấn

              if (item.hoadon_code === "") {
                  code = "chưa tạo hóa đơn";
              } else {
                  code = item.hoadon_code;
              }

              const hoadon = {
                  hoadon_id: hoadon_id,
                  hoadon_code: code,
                  hoadon_allprice: item.hoadon_allprice,
                  created_at: item.created_at,
                  product_count: rowCount // Thêm số sản phẩm vào đối tượng hoadon
              };

              arr.push(hoadon);

              // Kiểm tra xem đã duyệt qua hết kết quả trong vòng lặp chưa
              if (index === results.length - 1) {
                  // Trả về kết quả dưới dạng JSON response khi đã duyệt qua tất cả kết quả
                  return res.json({ status: "success", results: arr });
              }
          });
      });
  });
}


exports.getdeatilPayment = (req, res) => {
  const hoadon_id = req.params.hoadon_id;
  let is_voucher = "";
  let hoadon_code = "";

  connection.query('SELECT * FROM tbl_hoadon WHERE hoadon_id = ?', [hoadon_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    if (results[0].is_voucher === 0) {
      is_voucher = "không áp dụng voucher";
    } else {
      is_voucher = "có áp dụng voucher";
    }

    if (results[0].hoadon_code === "") {
      hoadon_code = "Đơn hàng chưa được duyệt";
    } else {
      hoadon_code = results[0].hoadon_code;
    }

    connection.query('SELECT tbl_hoadon.*, tbl_category_payment.category_payment_name FROM tbl_hoadon JOIN tbl_category_payment ON tbl_hoadon.category_payment_id = tbl_category_payment.category_payment_id WHERE tbl_hoadon.hoadon_id = ?', [hoadon_id], (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }

      const arrhoadon = {
        hoadon_code: hoadon_code,
        hoadon_allprice: results[0].hoadon_allprice,
        status_payment_id: results[0].status_payment_id,
        category_payment_name: results[0].category_payment_name,
        vocher_id: results[0].vocher_id,
        is_voucher: is_voucher,
        hoadon_address: results[0].hoadon_address,
        created_at: results[0].created_at,
      };

      connection.query('SELECT tbl_hoadon_deatil.*, tbl_product.*, tbl_theloai.theloai_name FROM tbl_hoadon_deatil JOIN tbl_product ON tbl_hoadon_deatil.product_id = tbl_product.product_id JOIN tbl_theloai ON tbl_product.theloai_id = tbl_theloai.theloai_id WHERE tbl_hoadon_deatil.hoadon_id = ?;', [hoadon_id], (error, results) => {
        if (error) {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        }

        const listproduct = results.map((item) => ({
          theloai_name: item.theloai_name,
          product_brand: item.product_brand,
          product_name: item.product_name,
          product_price: item.product_price,
          hoadondeatil_quantyti: item.hoadondeatil_quantyti,
          hoadon_size: item.hoadon_size,
          hoadon_color: item.hoadon_color,
        }));

        arrhoadon.listproduct = listproduct;

        return res.json({ status: "success", results: arrhoadon });
      });
    });
  });
};


