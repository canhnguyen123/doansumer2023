@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số trạng thái : {{ $count }}</h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('status_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_status" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý trạng thái   
    </div>
    <div class="col-12">
      <table id="statusTable" class="table" ui-jq="footable" ui-options='{
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
          <tr class="table-dark">
            <th data-breakpoints="xs">STT</th>
            <th>Tên trạng thái </th>
            <th style="text-align: center">Mã trạng thái</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="status_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_status as $key =>$item_status )
      @php
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
            <td>{{ $item_status->status_name }}</td>
            <td style="text-align: center" >{{ $item_status->status_code }}</td>
              <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('status_update', ['status_id' => $item_status->status_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                
            </div></td>
          </tr>
          @endforeach
      
          
        </tbody>
      </table>
      @if ($check==1)
      <div class="load-more flex_center">
       
           <button id="load-more-status" data-stt="{{$i}}" data-id="{{ $list_status->last()->status_id }}">Xem thêm</button>
       
      </div>
      @endif
    </div>
  </div>
</div>
</section>
</section>
@endsection