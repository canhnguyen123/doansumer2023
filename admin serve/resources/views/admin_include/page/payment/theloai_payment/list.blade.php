@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số phương thức thanh toán :{{ $count }}</h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{route('category_payment_add')}}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_payment_list" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
     
        
          
         
       
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý tổng số phương thức thanh toán   
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
            <th  colspan="1" data-breakpoints="xs">STT</th>
           <th colspan="3">Tên phương thức thanh toán</th>
           <th  colspan="3">Mô tả ngắn </th>
           <th colspan="1" class="flex_center ">Trạng thái </th>
           <th colspan="2" style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="status_payment_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_category_payment as $key =>$item_payment_list )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="status_payment-item">
            <td colspan="1">{{$i}}</td>
            <td colspan="3">  {{$item_payment_list->category_payment_name}}</td>
            <td colspan="3" >  {{$item_payment_list->category_payment_note}}</td>
            <td colspan="1"  style="text-align: center">
            @if ($item_payment_list->category_payment_status == 1)
                <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
            @elseif($item_payment_list->category_payment_status == 0)
                <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
            @endif
            </td>
             <td colspan="2" ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('category_payment_update', ['category_payment_id' => $item_payment_list->category_payment_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                  @if ($item_payment_list->category_payment_status == 1)
                      <a onclick="return confirm('Bạn có muốn chuyển p sang trạng thái tắt không?')"
                          href="{{ route('togggle_category_payment', ['category_payment_id' => $item_payment_list->category_payment_id, 'category_payment_status' => 1]) }}"><i
                              class="fa-solid fa-toggle-on"></i></a>
                  @else
                      <a onclick="return confirm('Bạn có muốn chuyển trạng thái bật không ?')"
                          href="{{ route('togggle_category_payment', ['category_payment_id' => $item_payment_list->category_payment_id, 'category_payment_status' => 0]) }}"><i
                              class="fa-solid fa-toggle-off"></i></a>
                  @endif
              </div>
            </div></td>
          </tr>
          @endforeach
      
          
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