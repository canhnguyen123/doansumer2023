const unidecode = require('unidecode');
const connection = require('../config/connection');
const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { error } = require('console');
exports.getAllProduct = (req, res) => {
  const Promise = require('bluebird'); // Import Promise library (for example, Bluebird)

  connection.query('SELECT * FROM tbl_theloai WHERE show_home = 1 AND theloai_status = 1', (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
  
    const theloaiList = results.map((row) => {
      const theloai_id = row.theloai_id;
      const theloai_name = row.theloai_name;
      const queryPromise = new Promise((resolve, reject) => {
        connection.query('SELECT * FROM tbl_product WHERE product_status = 1 AND theloai_id = ? ORDER BY product_id DESC LIMIT 3', theloai_id, (error, results) => {
          if (error) {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            reject(error);
          } else {
            resolve(results);
          }
        });
      });
  
      return queryPromise.then((productResults) => {
        const listProductPromises = productResults.map((product) => {
          return new Promise((resolve, reject) => {
            connection.query('SELECT * FROM tbl_list_img__product WHERE product_id = ? ORDER BY img_id DESC LIMIT 1', product.product_id, (error, imgResults) => {
              if (error) {
                console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
                reject(error);
              } else {
                const productImg = imgResults[0];
                const listImg =productImg.img_name ;
                const productData = {
                  product_id: product.product_id,
                  product_name: product.product_name,
                  product_price: product.product_price,
                  img_url:  listImg
                };
                resolve(productData);
              }
            });
          });
        });
  
        return Promise.all(listProductPromises)
          .then((listProduct) => {
            return {
              theloai_id: theloai_id,
              theloai_name: theloai_name,
              list_product: listProduct
            };
          })
          .catch((error) => {
            console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
            reject(error);
          });
      });
    });
  
    Promise.all(theloaiList)
      .then((finalResults) => {
        const response = { status: 'success',results: finalResults};
        return res.json(response);
      })
      .catch((error) => {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      });
  });
  
};
exports.getListCase=(req,res)=>{
  const arrCategory = [];

  connection.query('SELECT * FROM tbl_category WHERE category_status = 1', async (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
  
    try {
      for (const categoryRow of results) {
        const category_id = categoryRow.category_id;
        const category_name = categoryRow.category_name;
  
        const phanloaiResults = await query('SELECT * FROM tbl_phanloai WHERE phanloai_status = 1');
        const listPhanloai = await Promise.all(
          phanloaiResults.map(async (phanloaiRow) => {
            const phanloai_id = phanloaiRow.phanloai_id;
            const phanloai_name = phanloaiRow.phanloai_name;
  
            const theloaiResults = await query('SELECT * FROM tbl_theloai WHERE theloai_status = 1 AND category_id = ? AND phanloai_id = ?', [category_id, phanloai_id]);
            const listTheloai = theloaiResults.map((theloaiRow) => {
              const theloai_id = theloaiRow.theloai_id;
              const theloai_name = theloaiRow.theloai_name;
              const theloai_img = theloaiRow.theloai_link_img;
              return {
                theloai_id: theloai_id,
                theloai_name: theloai_name,
                theloai_img:theloai_img,
              };
            });
  
            return {
              phanloai_id: phanloai_id,
              phanloai_name: phanloai_name,
              listTheloai: listTheloai
            };
          })
        );
  
        const category = {
          category_id: category_id,
          category_name: category_name,
          listPhanloai: listPhanloai
        };
  
        arrCategory.push(category);
      }
  
      const arrCategorylist = arrCategory;
      res.json({ status: 'success', arrCategorylist: arrCategorylist });
    } catch (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
  });
  
  function query(sql, params) {
    return new Promise((resolve, reject) => {
      connection.query(sql, params, (error, results) => {
        if (error) {
          reject(error);
        } else {
          resolve(results);
        }
      });
    });
  }
  
}  

exports.getdeatilCase = (req, res) => {
  const theloai_id = req.params.theloai_id;
  connection.query('SELECT * FROM tbl_theloai WHERE theloai_id=?', [theloai_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const retrieved_theloai_id = results[0].theloai_id;
    const retrieved_theloai_name = results[0].theloai_name;
  
    connection.query('SELECT * FROM tbl_product WHERE theloai_id=?', [retrieved_theloai_id], (error, result_Pro) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
  
      const productList = result_Pro.map(async product => {
        const imgResult = await getImageForProduct(product.product_id);
        const latestImage = imgResult[0].img_name; // Lấy link của ảnh mới nhất
  
        return {
          product_id: product.product_id,
          product_name: product.product_name,
          product_price: product.product_price,
          latest_image: latestImage
        };
      });
  
      Promise.all(productList).then(completedList => {
        const response = {
          theloai_id: retrieved_theloai_id,
          theloai_name: retrieved_theloai_name,
          productList: completedList
        };
        res.json({ results: response });
      }).catch(error => {
        console.error('Lỗi khi lấy thông tin ảnh: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi khi lấy thông tin ảnh' });
      });
    });
  });
  
  // Hàm lấy thông tin ảnh mới nhất cho một sản phẩm dựa trên product_id
  function getImageForProduct(product_id) {
    return new Promise((resolve, reject) => {
      connection.query('SELECT * FROM tbl_list_img__product WHERE product_id=? ORDER BY img_id  DESC LIMIT 1', [product_id], (error, result) => {
        if (error) {
          reject(error);
        } else {
          resolve(result);
        }
      });
    });
  }
  
};
exports.getDeatil = (req, res) => {
  const product_id = req.params.product_id;
  connection.query('SELECT * FROM tbl_product WHERE product_id = ?', [product_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    if (results.length === 0) {
      return res.status(404).json({ error: 'Không tìm thấy sản phẩm' });
    }

    const product_idPro = results[0].product_id;
    const arrProduct = {
      product_id: product_idPro,
      product_name: results[0].product_name,
      product_brand: results[0].product_brand,
      product_status_Ha: results[0].product_status_Ha,
      product_code: results[0].product_code,
      product_price: results[0].product_price,
      product_mota: results[0].product_mota,
      product_dacdiem: results[0].product_dacdiem,
      product_baoquan: results[0].product_baoquan,
    };
    connection.query("SELECT *FROM tbl_quantity_product  WHERE  quantity_status=1 AND product_id=?",[product_idPro],(error,results)=>{
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
      
      const arr_list_quantity = results.map((quantityPro) => ({
        quantity_color: quantityPro.quantity_color,
        quantity_size: quantityPro.quantity_size,
        quantity_sl: quantityPro.quantity_sl,
      }));
      
      arrProduct.listquantity = arr_list_quantity;
    })
    connection.query('SELECT * FROM tbl_list_img__product WHERE product_id = ?', [product_idPro], (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
      
      const arr_list_img = results.map((imgPro) => ({
         imgProduct_link: imgPro.img_name,
      }));
      
      arrProduct.listImg = arr_list_img;
      
     
      return res.json({ results: arrProduct });
    });
  });
};


