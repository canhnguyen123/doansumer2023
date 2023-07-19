@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số chức vụ : {{ $count }} </h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('phanquyen_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_phanquyen" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý phân quyền   
    </div>
    <div class="col-12">
      <table id="phanquyenTable" class="table" ui-jq="footable" ui-options='{
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
            <th>Tên nhóm quyền </th>
            <th>Mô tả </th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="phanquyen_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_phanquyen as $key =>$item_phanquyen )
      @php
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
            <td>{{ $item_phanquyen->phanquyen_nameGroup}}</td>
            <td>{{ $item_phanquyen->phanquyen_note}}</td>
            <td ><div class="flex_center icons">
              <div class="icon bg-bule flex_center">
                <a href="{{ route('phanquyen_update', ['phanquyen_id' => $item_phanquyen->phanquyen_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
               </div>
               <div class="icon bg-red flex_center">
                   
                    @if ($item_phanquyen->phanquyen_status== 1)
                    <a onclick="return confirm('Bạn có muốn chuyển voucher này sang trạng thái tắt không?')"
                        href="{{ route('togggle_status_phannuyen', ['phanquyen_id' => $item_phanquyen->phanquyen_id,'phanquyen_status' => 1]) }}"><i
                            class="fa-solid fa-toggle-on"></i></a>
                  @else
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
                        href="{{ route('togggle_status_phannuyen', ['phanquyen_id' => $item_phanquyen->phanquyen_id,'phanquyen_status' => 0]) }}"><i
                            class="fa-solid fa-toggle-off"></i></a>
                   @endif
               
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