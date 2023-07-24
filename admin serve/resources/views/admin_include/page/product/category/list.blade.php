@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số danh mục : {{ $count }} </h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('category_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_category" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý danh mục   
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
            <th>Tên danh mục </th>
            <th style="text-align: center">Mã danh mục</th>
            <th style="text-align: center">Trạng thái</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="category_list_table">
              @php
              $i = 0;
            @endphp
          @foreach ($list_category as $key =>$item_category )
          @php
          $i++;
          @endphp
              <tr data-expanded="true">
                <td>{{ $i }}</td>
                <td>{{ $item_category->category_name }}</td>
                <td style="text-align: center" >{{ $item_category->category_code }}</td>
                <td style="text-align: center">
                  <p class="reslut_categgory_icon" style="display: none">{{ $item_category->category_status }}</p>
                  @if($item_category->category_status==1)
                  
                  <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                  @elseif($item_category->category_status==0)
                  <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                  @endif
              
                  
                  
                </td>
                
                <td ><div class="flex_center icons">
                    <div class="icon bg-bule flex_center">
                    <a href="{{ route('category_update', ['category_id' => $item_category->category_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                    </div>
                    <div class="icon bg-red flex_center">
                      @if ($item_category->category_status==1)
                      <a onclick="return confirm('Bạn có muốn chuyển danh mục này sang trạng thái tắt không?')" href="{{ route('togggle_status_category', ['category_id' => $item_category->category_id, 'category_status' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
                      @else
                      <a onclick="return confirm('Bạn có muốn chuyển danh mục này sang trạng thái bật không ?')" href="{{ route('togggle_status_category', ['category_id' => $item_category->category_id,'category_status'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
                    @endif
                    </div>
                  
                </div></td>
              </tr>
              @endforeach
          
            
            </tbody>
      </table>
      @if ($count>5)
      <div class="load-more flex_center">
       
           <button id="load-more-category" data-stt="{{$i}}" data-id="{{ $list_category->last()->category_id }}">Xem thêm</button>
       
      </div>
      @endif
    </div>
  </div>
</div>
</section>
</section>
@endsection