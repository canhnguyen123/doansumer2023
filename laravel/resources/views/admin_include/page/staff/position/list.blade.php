@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số chức vụ : {{ $count_position }} </h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('position_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_position" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý chức vụ   
    </div>
    <div class="col-12">
      <table id="positionTable" class="table" ui-jq="footable" ui-options='{
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
            <th>Tên chức vụ </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="position_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_position as $key =>$item_position )
      @php
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
            <td>{{ $item_position->chucvu_name}}</td>
            <td ><div class="flex_center icons">
               <div class="icon bg-red flex_center">
                    <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('position_delete', ['position_id' => $item_position->chucvu_id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
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