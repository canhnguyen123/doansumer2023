@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số banner :{{ $count }}</h3>
            </div>
            <div class="col-6 right">
              <div class="search_icon icon flex_center bg-bule" id="fiter_icon">
                <i class="fa-solid fa-filter"></i>
              </div>
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('banner_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_banner" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
     
        
          
         
       
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý banner   
    </div>
    <div class="col-12">
      <table id="bannerTable" class="table" ui-jq="footable" ui-options='{
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
           
            <th >Tên banner</th>
            <th class="flex_center ">
               <div data-status="all"  id="filterAll" class="fiter-status-banner filter-option td-table-titel">
                Trạng thái 
             </div> 
             
            </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="banner_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_banner as $key =>$item_banner )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="banner-item">
            <td>{{ $i }}</td>
            <td  class="d-flex  align-items-center">
              <div style="min-height: 35px" class="img_child"><img class="img_child_icon" src="{{ $item_banner->banner_link }}" alt=""> 
                {{ $item_banner->banner_node }}</div> </td>
            <td style="text-align: center"  data-value="{{ $item_banner->banner_status }}">
              @if($item_banner->banner_status==1)
               <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
              @elseif($item_banner->banner_status==0)
              <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
              @endif
              </td>
            
            <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('banner_update', ['banner_id' => $item_banner->banner_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                    <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('banner_delete', ['banner_id' => $item_banner->banner_id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
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