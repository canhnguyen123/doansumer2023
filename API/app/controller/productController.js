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
  connection.query('SELECT  tbl_product.*, tbl_theloai.theloai_name,tbl_category.category_name,  tbl_phanloai.phanloai_name FROM tbl_product JOIN tbl_theloai ON tbl_product.theloai_id = tbl_theloai.theloai_id JOIN tbl_phanloai ON tbl_theloai.phanloai_id = tbl_phanloai.phanloai_id JOIN tbl_category ON tbl_theloai.category_id = tbl_category.category_id WHERE tbl_product.product_id = ? AND  tbl_product.product_status =1', [product_id], (error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    
    if (results.length === 0) {
      return res.json({status:'fail', mess: 'Không tìm thấy sản phẩm' });
    }

    const product_idPro = results[0].product_id;
    const arrProduct = {
      product_id: product_idPro,
      category_name: results[0].category_name,
      phanloai_name: results[0].phanloai_name,
      theloai_name: results[0].theloai_name,
      product_name: results[0].product_name,
      product_brand: results[0].product_brand,
      product_status_Product: results[0].product_status_Ha,
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
      const unique_sizes = new Set(results.map((size) => size.quantity_size));
      const arr_list_size = Array.from(unique_sizes).map((quantity_size) => ({
        quantity_size,
      }));
  
      // Using Set to remove duplicates from the list_color array
      const unique_colors = new Set(results.map((color) => color.quantity_color));
      const arr_list_color = Array.from(unique_colors).map((quantity_color) => ({
        quantity_color,
      }));
  
      arrProduct.listquantity = arr_list_quantity;
      arrProduct.listsize = arr_list_size;
      arrProduct.listcolor = arr_list_color;
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
      
     
      return res.json({status:'success', results: arrProduct });
    });
  });
};
exports.getAll = (req, res) => {
  connection.query(
    'SELECT * FROM tbl_product ORDER BY product_id DESC', // Sắp xếp theo product_id giảm dần (từ mới đến cũ)
    (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }
      // Tạo một mảng chứa các sản phẩm
      const products = results.map(item => {
        const product = {
          product_id: item.product_id,
          product_name: item.product_name,
          product_brand: item.product_brand,
          product_status_Ha: item.product_status_Ha,
          product_code: item.product_code,
          product_price: item.product_price,
          product_mota: item.product_mota,
          product_dacdiem: item.product_dacdiem,
          product_baoquan: item.product_baoquan,
        };
        return product;
      });

      // Lặp qua từng sản phẩm để thêm thông tin về số lượng và hình ảnh
      Promise.all(
        products.map(product => {
          return new Promise((resolve, reject) => {
            connection.query(
              'SELECT * FROM tbl_quantity_product WHERE quantity_status = 1 AND product_id = ?',
              [product.product_id],
              (error, results) => {
                if (error) {
                  reject(error);
                }

                const arr_list_quantity = results.map(quantityPro => ({
                  quantity_color: quantityPro.quantity_color,
                  quantity_size: quantityPro.quantity_size,
                  quantity_sl: quantityPro.quantity_sl,
                }));

                product.listquantity = arr_list_quantity;

                connection.query(
                  'SELECT * FROM tbl_list_img__product WHERE product_id = ?',
                  [product.product_id],
                  (error, results) => {
                    if (error) {
                      reject(error);
                    }

                    const arr_list_img = results.map(imgPro => ({
                      imgProduct_link: imgPro.img_name,
                    }));

                    product.listImg = arr_list_img;
                    resolve();
                  }
                );
              }
            );
          });
        })
      )
        .then(() => {
          // Khi đã lấy thông tin về số lượng và hình ảnh cho tất cả sản phẩm, gửi kết quả về cho client
          return res.json({status:'success',  results: products });
        })
        .catch(error => {
          console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
          return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
        });
    }
  );
};
exports.getColor = (req, res) => {
  connection.query('SELECT *FROM tbl_color WHERE color_status =1',(error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr = results.map(item => ({
      color_name: item.color_name,
      color_code: item.color_code
    }));
    return res.json({status:'success',results:arr});
  })
};
exports.getCateory = (req, res) => {
  connection.query('SELECT *FROM tbl_category WHERE category_status =1',(error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr = results.map(item => ({
      category_id: item.category_id,
      category_name: item.category_name,
    }));
    return res.json({status:'success',results:arr});
  })
};
exports.getPhanloai = (req, res) => {
  connection.query('SELECT *FROM tbl_phanloai WHERE phanloai_status =1',(error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr = results.map(item => ({
      phanloai_id: item.phanloai_id,
      phanloai_name: item.phanloai_name,
    }));
    return res.json({status:'success',results:arr});
  })
};
exports.getTheloai = (req, res) => {
  const category_id=req.body.category_id;
  const phanloai_id=req.body.phanloai_id;
  const arrCheck={category_id:category_id,phanloai_id:phanloai_id}
  connection.query('SELECT *FROM tbl_theloai WHERE theloai_status =1 AND ?',[arrCheck],(error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr = results.map(item => ({
      theloai_id: item.theloai_id,
      theloai_name: item.theloai_name,
    }));
    return res.json({status:'success',results:arr});
  })
};
exports.getSize = (req, res) => {
  connection.query('SELECT *FROM tbl_size WHERE status_size =1',(error, results) => {
    if (error) {
      console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
      return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
    }
    const arr = results.map(item => ({
      name_size: item.name_size,
    }));
    return res.json({status:'success',results:arr});
  })
};
exports.getrelate = (req, res) => {
  const theloai_id = req.params.theloai_id;
  const product_id = req.params.product_id;
  connection.query(
    'SELECT tbl_product.*, GROUP_CONCAT(tbl_list_img__product.img_name) AS img_name ' +
    'FROM tbl_product ' +
    'LEFT JOIN tbl_list_img__product ON tbl_product.product_id = tbl_list_img__product.product_id ' +
    'WHERE tbl_product.theloai_id = ? ' +
    'GROUP BY tbl_product.product_id ' +
    'ORDER BY tbl_product.product_id DESC ' +
    'LIMIT 10',
    [theloai_id],
    (error, results) => {
      if (error) {
        console.error('Lỗi truy vấn cơ sở dữ liệu: ' + error.stack);
        return res.status(500).json({ error: 'Lỗi truy vấn cơ sở dữ liệu' });
      }

      const products = [];
      results.forEach(item => {
        if (item.product_id != product_id) {
          const product = {
            product_id: item.product_id,
            product_name: item.product_name,
            product_price: item.product_price,
            img_name: item.img_name
          };
          products.push(product);
        }
      });

      return res.json({status:'success',results:products});
    }
  );
};


