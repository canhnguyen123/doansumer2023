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
Route::get('/','homeController@index');
Route::get('/', [homeController::class, 'index']);
Route::get('/trang-chu','homeController@index');

///Admin(BE)

Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('/login-admin', [AdminController::class, 'login'])->name('login');
    Route::post('/login-post', [AdminController::class, 'post_login']);
    
    Route::get('/logout-admin', [AdminController::class, 'logout'])->name('logout');
    Route::prefix('/login')->group(function () {

    });
    Route::prefix('/page')->group(function () {
        Route::prefix('/product')->group(function () {
            Route::prefix('/category')->group(function () {
                Route::get('/list', [CategoryProductController::class, 'category_list'])->name('category_list');
                Route::get('/add', [CategoryProductController::class, 'category_add'])->name('category_add');
                 Route::get('/update/{category_id}', [CategoryProductController::class, 'category_update'])->name('category_update');
                Route::get('/delete/{category_id}', [CategoryProductController::class, 'category_delete'])->name('category_delete');
                Route::post('/post-add', [CategoryProductController::class, 'post_category_add'])->name('category_post_add');
                Route::post('/post-update/{category_id}', [CategoryProductController::class, 'post_category_update'])->name('category_post_update');
            });
            Route::prefix('/phanloai')->group(function () {
                Route::get('/list', [phanloaiController::class, 'phanloai_list'])->name('phanloai_list');
                Route::get('/add', [phanloaiController::class, 'phanloai_add'])->name('phanloai_add');
                Route::get('/update/{phanloai_id}', [phanloaiController::class, 'phanloai_update'])->name('phanloai_update');
                Route::get('/delete/{phanloai_id}', [phanloaiController::class, 'phanloai_delete'])->name('phanloai_delete');
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
                Route::get('/size-delete/{id_size}', [sizeProductController::class, 'size_delete'])->name('size_delete');
                Route::post('/post-size-add', [sizeProductController::class, 'post_size_add'])->name('post_size_add');
               Route::post('/post-size-update/{id_size}', [sizeProductController::class, 'post_size_update'])->name('post_size_update');
            });
         
            Route::prefix('/theloai')->group(function () {
                Route::get('/list', [theloaiProductController::class, 'theloai_list'])->name('theloai_list');
                Route::get('/add', [theloaiProductController::class, 'theloai_add'])->name('theloai_add');
                Route::get('/update/{theloai_id}', [theloaiProductController::class, 'theloai_update'])->name('theloai_update');
                Route::get('/delete/{theloai_id}', [theloaiProductController::class, 'theloai_delete'])->name('theloai_delete');
                Route::post('/post-add', [theloaiProductController::class, 'post_theloai_add'])->name('post_theloai_add');
                Route::post('/post-update/{theloai_id}', [theloaiProductController::class, 'post_theloai_update'])->name('post_theloai_update');
            });
            Route::prefix('/color')->group(function () {
                Route::get('/list', [colorController::class, 'color_list'])->name('color_list');
                Route::get('/add', [colorController::class, 'color_add'])->name('color_add');
                Route::get('/update/{color_id}', [colorController::class, 'color_update'])->name('color_update');
                Route::get('/delete/{color_id}', [colorController::class, 'color_delete'])->name('color_delete');
                Route::post('/post-add', [colorController::class, 'post_color_add'])->name('post_color_add');
                Route::post('/post-update/{color_id}', [colorController::class, 'post_color_update'])->name('post_color_update');
            });
            Route::prefix('/brand')->group(function () {
                Route::get('/list', [brandController::class, 'brand_list'])->name('brand_list');
                Route::get('/add', [brandController::class, 'brand_add'])->name('brand_add');
                Route::get('/update/{brand_id}', [brandController::class, 'brand_update'])->name('brand_update');
                Route::get('/delete/{brand_id}', [brandController::class, 'brand_delete'])->name('brand_delete');
                Route::post('/post-add', [brandController::class, 'post_brand_add'])->name('post_brand_add');
                Route::post('/post-update/{brand_id}', [brandController::class, 'post_brand_update'])->name('post_brand_update');
            });
           
            Route::prefix('/product')->group(function () {
                Route::get('/list', [ProductController::class, 'product_list'])->name('product_list');
                Route::get('/add', [productController::class, 'product_add'])->name('product_add');
                Route::get('/update/{brand_id}', [productController::class, ''])->name('');
                Route::get('/delete/{brand_id}', [productController::class, ''])->name('');
                Route::post('/post-add', [productController::class, 'post_product_add'])->name('post_product_add');
                Route::post('/post-update/{brand_id}', [productController::class, ''])->name('');
            });
            //Product
        });
        Route::prefix('/staff')->group(function () {
            Route::prefix('/position')->group(function () {
                Route::get('/list', [positionController::class, 'position_list'])->name('position_list');
                Route::get('/add', [positionController::class, 'position_add'])->name('position_add');
                Route::get('/delete/{position_id}', [positionController::class, 'position_delete'])->name('position_delete');
                Route::post('/post-add', [positionController::class, 'post_position_add'])->name('post_position_add'); 
            });
        });
        Route::prefix('/banner')->group(function () {
            Route::get('/list', [bannerController::class, 'banner_list'])->name('banner_list');
            Route::get('/add', [bannerController::class, 'banner_add'])->name('banner_add');
             Route::get('/update/{banner_id}', [bannerController::class, 'banner_update'])->name('banner_update');
            Route::get('/delete/{banner_id}', [bannerController::class, 'banner_delete'])->name('banner_delete');
            Route::post('/post-add', [bannerController::class, 'post_banner_add'])->name('post_banner_add');
            Route::post('/post-update/{banner_id}', [bannerController::class, 'post_banner_update'])->name('post_banner_update');
        });
    });
  
    
    Route::prefix('/ajax')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/category-search', [Ajax_classController::class, 'ajax_category'])->name('category_search');
            Route::get('/phanloai-search', [Ajax_classController::class, 'ajax_phanloai'])->name('phanloai_search');
            Route::get('/size-search', [Ajax_classController::class, 'ajax_size'])->name('ajax_size');
            Route::get('/status-search', [Ajax_classController::class, 'ajax_status'])->name('ajax_status');
            Route::get('/color-search', [Ajax_classController::class, 'ajax_color'])->name('ajax_color');
            Route::get('/brand-search', [Ajax_classController::class, 'ajax_brand'])->name('ajax_brand');
            Route::post('/product-theloai', [Ajax_classController::class, 'ajax_select_theloai'])->name('product_theloai');
            });
    });
});
    // Các route trong nhóm '/admin'
   
    


