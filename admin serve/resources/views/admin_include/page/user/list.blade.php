@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số người dùng :{{ $count }}</h3>
            </div>
            <div class="col-6 right">
              <div class="search_icon icon flex_center  bg-bule" onclick="realoadProduct()" id="loadProduct">
                <i class="fa-solid fa-arrow-rotate-left"></i>
            </div>
              <div class="search_icon icon flex_center fiter-toggle bg-bule" id="fiter_icon">
                <i class="fa-solid fa-filter"></i>
            </div>
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href=""><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_user" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div>
        <div class="col-12 mg-20 data-fiter row" style="display: none">
          <div class="col-12 row">
            <div class="col-8">
                <div class="container">
                    <div class="row">
                      <div class="col-sm-12">
                        <div id="slider-range"></div>
                      </div>
                    </div>
                    <div class="row slider-labels">
                      <div class="col-6 caption pd-left">
                        <strong>Min:</strong>
                            {{-- <span id="slider-range-value1">  --}}
                            <input type="text" class="span-text"  id="slider-range-value1">
                        </span>
                      </div>
                      <div class="col-6 text-right caption">
                        <strong>Max:</strong> 
                             {{-- <span id="slider-range-value2"> --}}
                        <input type="text" class="span-text"   id="slider-range-value2">
                        </span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <form>
                          <input type="hidden" name="min-value" value="">
                          <input type="hidden" name="max-value" value="">
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-4 ip-form flex_center">
                    {{-- <select name="" class="koew" id="is-fiter-data">
                        <option value="1">Có lọc giá</option>
                        <option value="0">Không lọc giá</option>
                    </select> --}}
                <button class="koew" onclick="fiter_data_product()">Lọc</button>
            </div>
          </div>
        </div>
        
          
         
       
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý người dùng   
    </div>
    <div class="col-12">
      <table id="userTable" class="table" ui-jq="footable" ui-options='{
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
            <th>STT</th>
            <th >Tên người dùng</th>
            <th >Số điện thoại</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="user_list_table">
      @php
      $i = 0;
     @endphp
  @foreach ($list_user as $key =>$item_user )
  @php
  $i++;
  @endphp
      <tr data-expanded="true">
        <td>{{ $i }}</td>
        <td>{{ $item_user->user_fullname}}</td>
        <td >{{ $item_user->user_phone}}</td>
       <td ><div class="flex_center icons">
            <div class="icon bg-yellow flex_center">
             <a href="{{route('user_deatil',['user_id'=>$item_user->user_id])}}"><i class="fa-solid fa-eye"></i></a> 
            </div>
            <div class="icon bg-red flex_center">
              @if ($item_user->user_status==1)
              <a onclick="return confirm('Bạn có muốn bỏ khóa tài khoản  này không?')" href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id, 'user_status' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
              @else
              <a onclick="return confirm('Bạn có muốn tạm khóa tài khoản  này  không ?')" href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id,'user_status'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
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