@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số thể loại :{{ $count }} </h3>
            </div>
            <div class="col-6 right">
              <div class="search_icon icon flex_center bg-bule" id="fiter_icon">
                <i class="fa-solid fa-filter"></i>
              </div>
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('product_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_product" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
        <div class="col-12 mg-20 row">
          <div class="col-3 fiter">
            <label for="">Trạng thái</label>
            <select name="" id="product-status-fiter">
              <option value="all">Tất cả</option>
              <option value="1">Đang bật</option>
              <option value="0">Đang tắt</option>
            </select>
          </div>
          <div class="col-3 fiter">
            <label for="">Danh mục</label>
            <select name="" id="product-status-fiter">
              <option value="all">Tất cả</option>
              <option value="1">Đang bật</option>
              <option value="0">Đang tắt</option>
            </select>
          </div>
          <div class="col-3 fiter">
            <label for="">Phân loại</label>
            <select name="" id="product-status-fiter">
              <option value="all">Tất cả</option>
              <option value="1">Đang bật</option>
              <option value="0">Đang tắt</option>
            </select>
          </div>
          
         
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý thể loại   
    </div>
    <div class="col-12">
      <table id="productTable" class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <thead >
          <tr>
            <th data-breakpoints="xs">STT</th>
            <th >Tên thể loại</th>
            <th >Tên sản phẩm</th>
            <th >Giá</th>
            <th class="flex_center ">
               
                Trạng thái 
             </div> 
             
            </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="product_list_table">
     
        </tbody>
      </table>
      <div id="image-dialog" class="dialog">
        <img id="dialog-image" src="" alt="">
        <span id="close-btn" onclick="closeDialog()">&times;</span>
      </div>
    </div>
  </div>
</div>
</section>
</section>
@endsection