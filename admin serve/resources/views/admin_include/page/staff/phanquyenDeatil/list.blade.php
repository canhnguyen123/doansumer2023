@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        <div class="form-fiter row">
            <div class="col-6 left">
                <h3>Tổng số quyền chi tiết : {{ $count }} </h3>
            </div>
            <div class="col-6 right">
                <div class="search_icon icon flex_center  bg-bule" id="reaload-permission">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </div>
                <div class="search_icon icon flex_center fiter-toggle bg-bule" id="fiter_icon">
                    <i class="fa-solid fa-filter"></i>
                </div>
                <div class="search_icon icon flex_center bg-bule" id="search_icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search_icon icon flex_center add-icon bg-bule">
                    <a href="{{ route('phanquyenDeatil_add') }}"><i class="fa-solid fa-plus"></i></a> 
                </div>
            </div>
        </div>
        <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
            <input type="text" id="search_ajax_phanquyenDeatil" class="search-input" placeholder="Nhập thông tin cần tìm">
            <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
            <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none"  id="close_search"></i>
        </div><div class="col-12 mg-20 data-fiter row" style="display: none">
            <div class="col-12 row">
                <div class="col-3 fiter">
                    <label for="">Trạng thái
                        <i class="fa-solid fa-thumbs-up bg-cl-green mg-10-l check-status" id="like-up"
                            onclick="openThumdown()"></i>
                        <i class="fa-solid fa-thumbs-down bg-cl-red mg-10-l check-status" id="like-down"
                            onclick="openThumup()" style="display: none"></i>
                    </label>
                    <select name="" id="status-fiter-permission">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>
              
                <div class="col-3 fiter">
                    <label for="">Nhóm Quyền</label>
                        <select name="" id="permission-fiter-group">
                        <option value="all">Tất cả</option>
                        @foreach ($listPhanquyen as  $item)
                        <option value="{{$item->phanquyen_id}}">{{$item->phanquyen_nameGroup}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 ip-form flex_center" style="display: flex;align-items: flex-end">
               
                    <button class="" id="permission-fiter-deatil" onclick="">Lọc</button>
                </div>
            </div>
           
        </div>
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Quản lý phân quyền chi tiết   
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
            <th>STT</th>
            <th>Nhóm quyền </th>
            <th>Tên quyền chi tiết</th>
            <th style="text-align: center;">Trạng thái</th>
           <th style="text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody id="phanquyenDeatil_list_table">
          @php
          $i = 0;
         @endphp
      @foreach ($list_phanquyenDeatil as $key =>$item_phanquyen )
      @php
      $i++;
      @endphp
          <tr data-expanded="true">
            <td>{{ $i }}</td>
           <td>{{ $item_phanquyen->phanquyen_nameGroup}}</td>
            <td>{{ $item_phanquyen->phanquyenDeatil_name}} ({{ $item_phanquyen->phanquyenDeatil_route}})</td>
            <td style="text-align: center;"> 
                 @if ($item_phanquyen->phanquyenDeatil_status == 1)
                    <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                @elseif($item_phanquyen->phanquyenDeatil_status == 0)
                    <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                @endif
            </td>
            <td ><div class="flex_center icons">
              <div class="icon bg-bule flex_center">
                <a href="{{ route('phanquyenDeatil_update', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id]) }}"> <i class="fa-solid fa-pen"></i></a> 
               </div>
               <div class="icon bg-red flex_center">
                   
                    @if ($item_phanquyen->phanquyenDeatil_status== 1)
                    <a onclick="return confirm('Bạn có muốn chuyển voucher này sang trạng thái tắt không?')"
                        href="{{ route('togggle_status_phanquyenDeatl', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id,'phanquyenDeatil_status' => 1]) }}"><i
                            class="fa-solid fa-toggle-on"></i></a>
                  @else
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
                        href="{{ route('togggle_status_phanquyenDeatl', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id,'phanquyenDeatil_status' => 0]) }}"><i
                            class="fa-solid fa-toggle-off"></i></a>
                   @endif
               
                  </div>
            </div></td>
          </tr>
          @endforeach
      
          
        </tbody>
        <tfoot id="tfoot-permission">
          <tr>
              <td colspan="6">
                  @if ($list_phanquyenDeatil->total() > $list_phanquyenDeatil->perPage())
                      <div class="pagination flex_center">
                          <ul class="pagination">
                              <!-- Nút Previous -->
                              @if ($list_phanquyenDeatil->currentPage() > 1)
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $list_phanquyenDeatil->previousPageUrl() }}" aria-label="Previous">
                                          <span aria-hidden="true">&laquo;</span>
                                      </a>
                                  </li>
                              @endif
      
                              <!-- Các trang -->
                              @for ($i = 1; $i <= $list_phanquyenDeatil->lastPage(); $i++)
                                  <li class="page-item{{ ($list_phanquyenDeatil->currentPage() == $i) ? ' active' : '' }}">
                                      <a class="page-link" href="{{ $list_phanquyenDeatil->url($i) }}">{{ $i }}</a>
                                  </li>
                              @endfor
      
                              <!-- Nút Next -->
                              @if ($list_phanquyenDeatil->currentPage() < $list_phanquyenDeatil->lastPage())
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $list_phanquyenDeatil->nextPageUrl() }}" aria-label="Next">
                                          <span aria-hidden="true">&raquo;</span>
                                      </a>
                                  </li>
                              @endif
                          </ul>
                      </div>
                  @endif
              </td>
          </tr>
      </tfoot>
      
      </table>
     
    </div>
  </div>
</div>
</section>
</section>
@endsection