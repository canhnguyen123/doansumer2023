@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số trạng thái hóa đơn :{{ $count }}</h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{route('status_payment_add')}}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_status_payment" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
     
        
          
         
       
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý trạng thái hóa đơn   
    </div>
    <div class="col-12">
      <table id="status_paymentTable" class="table" ui-jq="footable" ui-options='{
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
           <th >Tên trạng thái hóa đơn</th>
           <th >Mô tả ngắn trạng thái hóa đơn</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="status_payment_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_status_payment as $key =>$item_status_payment )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="status_payment-item">
            <td>{{ $i }}</td>
            <td>  {{$item_status_payment->status_payment_name}}</td>
            <td>  {{$item_status_payment->status_payment_note}}</td>
             <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('status_payment_update', ['status_payment_id' => $item_status_payment->status_payment_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
            </div></td>
          </tr>
          @endforeach
      
          
        </tbody>
      </table>
      @if ($check==1)
      <div class="load-more flex_center">
         <button id="load-more-status-payment"class="btn-loadmore" data-stt="{{$i}}" data-id="{{ $list_status_payment->last()->status_payment_id }}">Xem thêm</button>
      </div>
      @endif
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