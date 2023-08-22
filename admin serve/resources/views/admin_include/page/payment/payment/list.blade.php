@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số hóa đơn :{{ $count }}</h3>
            </div>
            <div class="col-6 right">
          
                <div class="search_icon icon flex_center  bg-bule" onclick="realoadProduct()" id="loadProduct">
                  <i class="fa-solid fa-arrow-rotate-left"></i>
              </div>
                {{-- <div class="search_icon icon flex_center fiter-toggle bg-bule" id="fiter_icon">
                  <i class="fa-solid fa-filter"></i>
              </div> --}}
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_payment" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
        {{-- <div class="col-12 mg-20 data-fiter row" style="display: none">
          <div class="col-12 row">
           
            
          </div>
          <div class="col-12 row">
            <div class="col-8 row">
              <div class="ip-form col-6"><input type="text" placeholder="Giá thấp nhất"></div>
              <div class="ip-form col-6"><input type="text"></div>
               </div>
            <div class="col-4 ip-form flex_center">
                
                <button class="koew" onclick="fiter_data_product()">Lọc</button>
            </div>
          </div>
        </div>
         --}}
          
         
       
		<div class="table-agile-info">
 <div class="panel panel-default row mg-20">
    <div class="panel-heading heading">
     Quản lý  hóa đơn   
    </div>
    <div class="col-12 mg-40 flex_center">
      <div class="div-titel-h4 row">
        <div class="col-2 tab-item-table active flex_center" data-id="1">
          <h4>Chờ xác nhận</h4> 
       </div>
       <div class="col-2 tab-item-table flex_center" data-id="2">
         <h4>Đã duyệt và đóng gói</h4> 
      </div>
      <div class="col-2 tab-item-table flex_center" data-id="3">
       <h4>Đang giao hàng</h4> 
       </div>
      <div class="col-2 tab-item-table flex_center" data-id="4">
     <h4>Giao thành công</h4> 
     </div>
     <div class="col-2 tab-item-table flex_center" data-id="5">
      <h4>Đơn hàng đã hủy</h4> 
      </div>
      <div class="col-2 tab-item-table flex_center" data-id="6">
        <h4>Đơn hàng bị hủy</h4> 
        </div>
      </div>
    

    </div>
    <div class="col-12">
      <table id="paymentBill_table" class="table" ui-jq="footable" ui-options='{
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
           <th >Mã hóa đơn</th>
           <th >Tổng tiền</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="payment_list_tableBody">
        </tbody>
      </table>
      {{-- @if ($check==1)
      <div class="load-more flex_center">
       
           <button id="load-more-category"class="btn-loadmore" data-stt="{{$i}}" data-id="{{ $list_category->last()->category_id }}">Xem thêm</button>
       
      </div>
      @endif --}}
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