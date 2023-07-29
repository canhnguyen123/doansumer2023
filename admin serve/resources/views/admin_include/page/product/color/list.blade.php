@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số màu sắc : {{ $count }} </h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('color_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_color" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý màu sắc   
    </div>
    <div class="col-12">
      <table id="categoryTable" class="table" ui-jq="footable" ui-options='{
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
            <th>Tên màu sắc </th>
            <th style="text-align: center">Mã màu sắc</th>
            <th class="flex_center td-table-titel">
               <p data-status="all"  id="filterAll" class="fiter-status-category filter-option ">Trạng thái</p> 
             
            </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="color_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_color as $key =>$item_color )
      @php  
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
            <td>{{ $item_color->color_name }}</td>
            <td style="text-align: center" >{{ $item_color->color_code }}</td>
            <td style="text-align: center">
              <p class="reslut_categgory_icon" style="display: none">{{ $item_color->color_status }}</p>
              @if($item_color->color_status==1)
              
              <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
              @elseif($item_color->color_status==0)
              <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
              @endif
           
              
              
            </td>
            
            <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('color_update', ['color_id' => $item_color->color_id ]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                  @if ($item_color->color_status==1)
                  <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái tắt không?')" href="{{ route('togggle_status_color', ['color_id' => $item_color->color_id, 'color_status' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
                  @else
                  <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái bật không ?')" href="{{ route('togggle_status_color', ['color_id' => $item_color->color_id,'color_status'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
                 @endif                </div>
            </div></td>
          </tr>
          @endforeach
      
          
        </tbody>
      </table>
      @if ($check==1)
      <div class="load-more flex_center">
       
           <button id="load-more-color"class="btn-loadmore" data-stt="{{$i}}" data-id="{{ $list_color->last()->color_id }}">Xem thêm</button>
       
      </div>
      @endif
    </div>
  </div>
</div>
</section>
</section>
@endsection