@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số size : {{ $count }}</h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('size_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_size" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý phân loại   
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
            <th>Tên size </th>
            <th style="text-align: center">Mô tả</th>
            <th class="flex_center td-table-titel">
               <p data-status="all"  id="filterAll" class="fiter-status-category filter-option ">Trạng thái</p> 
              <div class="icon-titel flex_center">
                <i class="fa-sharp fa-solid fa-check bg-cl-green fiter-status-category filter-option" id="filter0" data-status="1"></i> 
                <i class="fa-solid fa-xmark bg-cl-red fiter-status-category filter-option"  id="filter1" data-status="0" ></i>
              </div>
            </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="size_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_size as $key =>$item_size )
      @php
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
            <td>{{ $item_size->name_size }}</td>
            <td style="text-align: center" >{{ $item_size->describle_size }}</td>
            <td style="text-align: center">
              <p class="reslut_categgory_icon" style="display: none">{{ $item_size->status_size }}</p>
              @if($item_size->status_size==1)
              
              <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
              @elseif($item_size->status_size==0)
              <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
              @endif
           
              
              
            </td>
            
            <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('size_update', ['id_size' => $item_size->id_size ]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                    <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('size_delete', ['id_size' => $item_size->id_size ]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
                </div>
            </div></td>
          </tr>
          @endforeach
      
          
        </tbody>
      </table>
    </div>
  </div>
</div>
</section>
</section>
@endsection