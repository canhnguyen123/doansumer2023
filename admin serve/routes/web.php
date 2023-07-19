<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\categoryProductController;
use App\Http\Controllers\Ajax_classController;
use App\Http\Controllers\productController;
use App\Http\Controllers\phanloaiController;
use App\Http\Controllers\sizeProductController;
use App\Http\Controllers\theloaiProductController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\colorController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\positionController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\userController;
use App\Http\Controllers\voucherController;
use App\Http\Controllers\status_paymentController;
use App\Http\Controllers\theloai_paymentController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\statisticalController;
use App\Http\Controllers\phanquyenController;
use App\Http\Controllers\phanquyenDeatilController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
///FE

Route::get('/', [homeController::class, 'index'])->name('trangchu');
#

///Admin(BE)

Route::prefix('/admin')->group(function () {
  
    Route::get('/login-admin', [AdminController::class, 'login'])->name('login');
    Route::post('/login-post', [AdminController::class, 'post_login'])->name('post_login');
    
  
// 
   Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminController::class, 'home'])->name('home');
        Route::post('/', [AdminController::class, 'updateShowHome'])->name('updateShowHome');
        Route::get('/logout-admin', [AdminController::class, 'logout'])->name('logout');
        Route::prefix('/page')->group(function () {
            Route::prefix('/payment')->group(function(){
                Route::prefix('/payment')->group(function(){
                    Route::get('/list', [paymentController::class, 'payment_list'])->name('payment_list');
                    Route::get('/deatil/{hoadon_id}', [paymentController::class, 'payment_deatil'])->name('payment_deatil');
                    Route::get('/togggle-status/{category_id}/{category_status}', [paymentController::class, 'togggle_status'])->name('togggle_status_category');
                    Route::post('/poss-add-bill/{hoadon_id}', [paymentController::class, 'post_bill_add'])->name('post_bill_add');
                });
                Route::prefix('/status_payment')->group(function(){
                    Route::get('/list', [status_paymentController::class, 'status_payment_list'])->name('status_payment_list');
                    Route::get('/add', [status_paymentController::class, 'status_payment_add'])->name('status_payment_add');
                    Route::get('/update/{status_payment_id}', [status_paymentController::class, 'status_payment_update'])->name('status_payment_update');
                    Route::post('/post-add', [status_paymentController::class, 'post_status_payment_add'])->name('post_status_payment_add');
                    Route::post('/post-update/{status_payment_id}', [status_paymentController::class, 'post_status_payment_update'])->name('post_status_payment_update');
                });
                Route::prefix('/theloai_payment')->group(function(){
                    Route::get('/list', [theloai_paymentController::class, 'category_payment_list'])->name('category_payment_list');
                    Route::get('/add', [theloai_paymentController::class, 'category_payment_add'])->name('category_payment_add');
                    Route::get('/update/{category_payment_id}', [theloai_paymentController::class, 'category_payment_update'])->name('category_payment_update');
                    Route::get('/togggle-status/{category_payment_id}/{category_payment_status}', [theloai_paymentController::class, 'togggle_status'])->name('togggle_category_payment');
                    Route::post('/post-add', [theloai_paymentController::class, 'post_category_payment_add'])->name('post_category_payment_add');
                    Route::post('/post-update/{category_payment_id}', [theloai_paymentController::class, 'post_category_payment_update'])->name('post_category_payment_update');
                });
            });
            Route::prefix('/product')->group(function () {
                Route::prefix('/category')->group(function () {
                    Route::get('/list', [CategoryProductController::class, 'category_list'])->name('category_list');
                    Route::get('/add', [CategoryProductController::class, 'category_add'])->name('category_add');
                     Route::get('/update/{category_id}', [CategoryProductController::class, 'category_update'])->name('category_update');
                     Route::get('/togggle-status/{category_id}/{category_status}', [CategoryProductController::class, 'togggle_status'])->name('togggle_status_category');
                    Route::post('/post-add', [CategoryProductController::class, 'post_category_add'])->name('category_post_add');
                    Route::post('/post-update/{category_id}', [CategoryProductController::class, 'post_category_update'])->name('category_post_update');
                });
                Route::prefix('/phanloai')->group(function () {
                    Route::get('/list', [phanloaiController::class, 'phanloai_list'])->name('phanloai_list');
                    Route::get('/add', [phanloaiController::class, 'phanloai_add'])->name('phanloai_add');
                    Route::get('/update/{phanloai_id}', [phanloaiController::class, 'phanloai_update'])->name('phanloai_update');
                    Route::get('/togggle-status/{phanloai_id}/{phanloai_status}', [phanloaiController::class, 'togggle_status'])->name('togggle_status_phanloai');
                    Route::post('/post-add', [phanloaiController::class, 'post_phanloai_add'])->name('post_phanloai_add');
                   Route::post('/post-update/{phanloai_id}', [phanloaiController::class, 'post_phanloai_update'])->name('post_phanloai_update');
                });
                Route::prefix('/status')->group(function () {
                    Route::get('-list', [statusController::class, 'status_list'])->name('status_list');
                    Route::get('/add', [statusController::class, 'status_add'])->name('status_add');
                    Route::get('/update/{status_id}', [statusController::class, 'status_update'])->name('status_update');
                    Route::get('/delete/{status_id}', [statusController::class, 'status_delete'])->name('status_delete');
                    Route::post('/post-add', [statusController::class, 'post_status_add'])->name('status_post_add');
                   Route::post('/post-update/{status_id}', [statusController::class, 'post_status_update'])->name('status_post_update');
                });
                Route::prefix('/size')->group(function () {
                    Route::get('/list', [sizeProductController::class, 'size_list'])->name('size_list');
                    Route::get('/size-add', [sizeProductController::class, 'size_add'])->name('size_add');
                    Route::get('/size-update/{id_size}', [sizeProductController::class, 'size_update'])->name('size_update');
                    Route::get('/togggle-status/{id_size}/{status_size}', [sizeProductController::class, 'togggle_status'])->name('togggle_status_size');
                    Route::post('/post-size-add', [sizeProductController::class, 'post_size_add'])->name('post_size_add');
                   Route::post('/post-size-update/{id_size}', [sizeProductController::class, 'post_size_update'])->name('post_size_update');
                });
             
                Route::prefix('/theloai')->group(function () {
                    Route::get('/list', [theloaiProductController::class, 'theloai_list'])->name('theloai_list');
                    Route::get('/add', [theloaiProductController::class, 'theloai_add'])->name('theloai_add');
                    Route::get('/update/{theloai_id}', [theloaiProductController::class, 'theloai_update'])->name('theloai_update');
                    Route::get('/togggle-status/{theloai_id}/{theloai_status}', [theloaiProductController::class, 'togggle_status'])->name('togggle_status_theloai');
                    Route::post('/post-add', [theloaiProductController::class, 'post_theloai_add'])->name('post_theloai_add');
                    Route::post('/post-update/{theloai_id}', [theloaiProductController::class, 'post_theloai_update'])->name('post_theloai_update');
                });
                Route::prefix('/color')->group(function () {
                    Route::get('/list', [colorController::class, 'color_list'])->name('color_list');
                    Route::get('/add', [colorController::class, 'color_add'])->name('color_add');
                    Route::get('/update/{color_id}', [colorController::class, 'color_update'])->name('color_update');
                    Route::get('/delete/{color_id}', [colorController::class, 'color_delete'])->name('color_delete');
                    Route::get('/togggle-status/{color_id}/{color_status}', [colorController::class, 'togggle_status'])->name('togggle_status_color');
                     Route::post('/post-add', [colorController::class, 'post_color_add'])->name('post_color_add');
                    Route::post('/post-update/{color_id}', [colorController::class, 'post_color_update'])->name('post_color_update');
                });
                Route::prefix('/brand')->group(function () {
                    Route::get('/list', [brandController::class, 'brand_list'])->name('brand_list');
                    Route::get('/add', [brandController::class, 'brand_add'])->name('brand_add');
                    Route::get('/update/{brand_id}', [brandController::class, 'brand_update'])->name('brand_update');
                    Route::get('/delete/{brand_id}', [brandController::class, 'brand_delete'])->name('brand_delete');
                    Route::get('/togggle-status/{brand_id}/{brand_status}', [brandController::class, 'togggle_status'])->name('togggle_status_brand');
                    Route::post('/post-add', [brandController::class, 'post_brand_add'])->name('post_brand_add');
                    Route::post('/post-update/{brand_id}', [brandController::class, 'post_brand_update'])->name('post_brand_update');
                });
               
                Route::prefix('/product')->group(function () {
                    Route::get('/list', [ProductController::class, 'product_list'])->name('product_list');
                    Route::get('/add', [productController::class, 'product_add'])->name('product_add');
                    Route::get('/update/{product_id}', [productController::class, 'product_update'])->name('product_update');
                    Route::get('/togggle-status/{product_id}/{product_status}', [productController::class, 'togggle_status'])->name('togggle_status_product');
                    Route::get('/deatil/{product_id}', [productController::class, 'product_deatil'])->name('product_deatil');
                    Route::get('/quantity/{product_id}', [productController::class, 'quantityProduct_list'])->name('quantityProduct_list');
                    Route::post('/post-add', [productController::class, 'post_product_add'])->name('post_product_add');
                    Route::post('/post-update/{product_id}', [productController::class, 'post_product_update'])->name('post_product_update');
                    Route::post('/post-add-quantity/{product_id}', [productController::class, 'post_quantity_add'])->name('post_quantity_add');
                    Route::post('/post-update-quantity/{quantity_id}', [productController::class, 'post_quantity_update'])->name('post_quantity_update');
                    Route::get('/togggle-status-quantity/{quantity_id}/{quantity_status}/{product_id}', [productController::class, 'togggle_status_quantity'])->name('togggle_status_quantity');
                  
                });
                //Product
            });
            Route::prefix('/staff')->group(function () {
                Route::prefix('/position')->group(function () {
                    Route::get('/list', [positionController::class, 'position_list'])->name('position_list');
                    Route::get('/add', [positionController::class, 'position_add'])->name('position_add');
                    Route::get('/update/{position_id}', [positionController::class, 'position_update'])->name('position_update');
                    Route::get('/deatil/{position_id}', [positionController::class, 'position_deatil'])->name('position_deatil');
                    Route::get('/togggle-status/{position_id}/{chucvu_status}', [positionController::class, 'togggle_status'])->name('togggle_status_position');
                    Route::post('/post-add', [positionController::class, 'post_position_add'])->name('post_position_add'); 
                    Route::post('/post-update/{position_id}', [positionController::class, 'post_position_update'])->name('post_position_update'); 
                });
                Route::prefix('/staff')->group(function(){
                    Route::get('/list', [staffController::class, 'staff_list'])->name('staff_list');
                    Route::get('/add', [staffController::class, 'staff_add'])->name('staff_add');
                    Route::get('/update/{staff_id}', [staffController::class, 'staff_update'])->name('staff_update');
                    Route::get('/deteal/{staff_id}', [staffController::class, 'staff_deteal'])->name('staff_deteal');
                    Route::get('/togggle-status/{staff_id}/{staff_status}', [staffController::class, 'togggle_status'])->name('togggle_status_staff');
                    Route::post('/post-add', [staffController::class, 'post_staff_add'])->name('post_staff_add'); 
                    Route::post('/post-update/{staff_id}', [staffController::class, 'post_staff_update'])->name('post_staff_update'); 
                });
                Route::prefix('/phanquyen')->group(function () {
                    Route::get('/list', [phanquyenController::class, 'phanquyen_list'])->name('phanquyen_list');
                    Route::get('/add', [phanquyenController::class, 'phanquyen_add'])->name('phanquyen_add');
                    Route::get('/update/{phanquyen_id}', [phanquyenController::class, 'phanquyen_update'])->name('phanquyen_update');
                    Route::get('/togggle-status/{phanquyen_id}/{phanquyen_status}', [phanquyenController::class, 'togggle_status_phannuyen'])->name('togggle_status_phannuyen');
                    Route::post('/post-add', [phanquyenController::class, 'post_phanquyen_add'])->name('post_phanquyen_add'); 
                    Route::post('/post-update/{phanquyen_id}', [phanquyenController::class, 'post_phanquyen_update'])->name('post_phanquyen_update'); 
                });
                Route::prefix('/phanquyenDeatil')->group(function () {
                    Route::get('/list', [phanquyenDeatilController::class, 'phanquyenDeatil_list'])->name('phanquyenDeatil_list');
                    Route::get('/add', [phanquyenDeatilController::class, 'phanquyenDeatil_add'])->name('phanquyenDeatil_add');
                    Route::get('/update/{phanquyenDeatil_id}', [phanquyenDeatilController::class, 'phanquyenDeatil_update'])->name('phanquyenDeatil_update');
                    Route::get('/togggle-status/{phanquyenDeatil_id}/{phanquyenDeatil_status}', [phanquyenDeatilController::class, 'togggle_status_phanquyenDeatl'])->name('togggle_status_phanquyenDeatl');
                    Route::post('/post-add', [phanquyenDeatilController::class, 'post_phanquyenDeatil_add'])->name('post_phanquyenDeatil_add'); 
                    Route::post('/post-update/{phanquyenDeatil_id}', [phanquyenDeatilController::class, 'post_phanquyenDeatil_update'])->name('post_phanquyenDeatil_update'); 
                });
            });
            Route::prefix('/banner')->group(function () {
                Route::get('/list', [bannerController::class, 'banner_list'])->name('banner_list');
                Route::get('/add', [bannerController::class, 'banner_add'])->name('banner_add');
                 Route::get('/update/{banner_id}', [bannerController::class, 'banner_update'])->name('banner_update');
                Route::get('/delete/{banner_id}', [bannerController::class, 'banner_delete'])->name('banner_delete');
                Route::get('/togggle-status/{banner_id}/{banner_status}', [bannerController::class, 'togggle_status'])->name('togggle_status_banner');
                Route::post('/post-add', [bannerController::class, 'post_banner_add'])->name('post_banner_add');
                Route::post('/post-update/{banner_id}', [bannerController::class, 'post_banner_update'])->name('post_banner_update');
            });
            Route::prefix('/user')->group(function () {
                Route::get('/list', [userController::class, 'user_list'])->name('user_list');
                Route::get('/deatil/{user_id}', [userController::class, 'user_deatil'])->name('user_deatil');
                Route::get('/togggle-status/{user_id}/{user_status}', [userController::class, 'togggle_status'])->name('togggle_status_user');
            });
            Route::prefix('/statistical')->group(function () {
                Route::get('/statistical', [statisticalController::class, 'statistical'])->name('statistical');
            });
            Route::prefix('/voucher')->group(function () {
                Route::get('/list', [voucherController::class, 'voucher_list'])->name('voucher_list');
                Route::get('/add', [voucherController::class, 'voucher_add'])->name('voucher_add');
                Route::get('/update/{voucher_id}', [voucherController::class, 'voucher_update'])->name('voucher_update');
                 Route::get('/deatil/{voucher_id}', [voucherController::class, 'voucher_deatil'])->name('voucher_deatil');
                Route::get('/togggle-status/{voucher_id}/{voucher_status}', [voucherController::class, 'togggle_status'])->name('togggle_status_voucher');
                Route::post('/post-add', [voucherController::class, 'post_voucher_add'])->name('post_voucher_add');
                Route::post('/post-update/{voucher_id}', [voucherController::class, 'post_voucher_update'])->name('post_voucher_update');
            });
        });
        Route::prefix('/account')->group(function () {
            Route::get('/setting/{id}', [admincontroller::class, 'setting'])->name('setting');
            Route::get('/update-password', [admincontroller::class, 'viewUpdatePassword'])->name('viewUpdatePassword');
            Route::post('/update-password-post/{id}', [admincontroller::class, 'updatePassword'])->name('updatePassword');
        });
        
        Route::prefix('/ajax')->group(function () {
            Route::prefix('/admin')->group(function () {
                Route::get('/category-search', [Ajax_classController::class, 'ajax_category'])->name('category_search');
                Route::get('/phanloai-search', [Ajax_classController::class, 'ajax_phanloai'])->name('phanloai_search');
                Route::get('/theloai-search', [Ajax_classController::class, 'ajax_theloai'])->name('theloai_search');
                Route::get('/theloai-product', [Ajax_classController::class, 'ajax_product'])->name('ajax_product');
                Route::get('/size-search', [Ajax_classController::class, 'ajax_size'])->name('ajax_size');
                Route::get('/status-search', [Ajax_classController::class, 'ajax_status'])->name('ajax_status');
                Route::get('/color-search', [Ajax_classController::class, 'ajax_color'])->name('ajax_color');
                Route::get('/brand-search', [Ajax_classController::class, 'ajax_brand'])->name('ajax_brand');
                Route::get('/user-search', [Ajax_classController::class, 'ajax_user'])->name('ajax_user');
                Route::post('/product-theloai', [Ajax_classController::class, 'ajax_select_theloai'])->name('product_theloai');
                Route::get('/delete-quantity', [Ajax_classController::class, 'delete_quantity'])->name('delete_quantity');     
                Route::get('/get-payment-status/{hoadon_status}', [Ajax_classController::class, 'get_payment_status'])->name('get_payment_status');
                Route::post('/select-allPrice', [Ajax_classController::class, 'get_allPrice'])->name('get_allPrice');
                Route::post('/select-data-table', [Ajax_classController::class, 'select_data_table'])->name('select_data_table');
                Route::get('/reset-load-product', [Ajax_classController::class, 'resetLoad'])->name('resetLoad');
                Route::post('/select-data-theloai', [Ajax_classController::class, 'select_data_theloai'])->name('select_data_theloai');
                Route::get('/reset-load-theloai', [Ajax_classController::class, 'resetLoadtheloai'])->name('resetLoadtheloai');
                Route::post('/select-data-user', [Ajax_classController::class, 'select_data_user'])->name('select_data_user');
            });
        });
     });
   
});
    // Các route trong nhóm '/admin'
   
    


