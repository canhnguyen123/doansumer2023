@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="form-fiter row">
                <div class="col-6 left">
                    <h3>Tổng số thể loại :{{ $count }}</h3>
                </div>
                <div class="col-6 right">
                    <div class="search_icon icon flex_center  bg-bule" onclick="realoadtheloai()" id="loadProduct">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </div>
                    <div class="search_icon icon flex_center bg-bule fiter-toggle" id="fiter_icon">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                    <div class="search_icon icon flex_center bg-bule" id="search_icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="search_icon icon flex_center add-icon bg-bule">
                        <a href="{{ route('theloai_add') }}"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
                <input type="text" id="search_ajax_theloai" placeholder="Nhập thông tin cần tìm">
                <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
                <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none" id="close_search"></i>
            </div>
            <div class="col-12 mg-20 data-fiter row" style="display: none">
                <div class="col-3 fiter">
                    <label for="">Trạng thái</label>
                    <select name="" id="theloai-status-fiter">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>
                <div class="col-3 fiter">
                    <label for="">Danh mục</label>
                    <select name="" id="category-fiter">
                        @foreach ($list_category as $item_category)
                        <option value="{{$item_category->category_id}}">{{$item_category->category_name}}</option>
                        @endforeach
                       </select>
                </div>
                <div class="col-3 fiter">
                    <label for="">Phân loại</label>
                    <select name="" id="phanloai-fiter">
                        @foreach ($list_phanloai as $item_phanloai)
                        <option value="{{$item_phanloai->phanloai_id}}">{{$item_phanloai->phanloai_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 fiter ip-form flex_bt">
                    <button  onclick="fiter_data_theloai()"><i class="fa-solid fa-filter" ></i> Lọc</button>
                </div>
            </div>
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Quản lý thể loại
                    </div>
                    <div class="col-12">
                        <table id="theloaiTable" class="table" ui-jq="footable"
                            ui-options='{
                                        "paging": {
                                        "enabled": true
                                        },
                                        "filtering": {
                                        "enabled": true
                                        },
                                        "sorting": {
                                        "enabled": true
                                        }}'>
                            <thead>
                                <tr>
                                    <th data-breakpoints="xs">STT</th>
                                    <th>Tên danh mục </th>
                                    <th>Tên phân loại</th>
                                    <th>Tên thể loại</th>
                                    <th class="flex_center ">
                                        <div data-status="all" id="filterAll"
                                            class="fiter-status-theloai filter-option td-table-titel">
                                            Trạng thái
                                        </div>

                                    </th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="theloai_list_table">
                                @php
                                    $i = ($list_theloai->currentPage() - 1) * $list_theloai->perPage() + 1;
                                @endphp
                                @foreach ($list_theloai as $key => $item_theloai)
                                    <tr data-expanded="true" class="theloai-item">
                                        <td>{{ $i }}</td>
                                        <td>{{ $item_theloai->category_name }}</td>
                                        <td>{{ $item_theloai->phanloai_name }}</td>
                                        <td class="d-flex  align-items-center">
                                            <div style="min-height: 35px" class="img_child">
                                                <img class="img_child_icon" src="{{ $item_theloai->theloai_link_img }}" alt="">
                                                {{ $item_theloai->theloai_name }}
                                            </div>
                                        </td>
                                        <td style="text-align: center" data-value="{{ $item_theloai->theloai_status }}">
                                            @if ($item_theloai->theloai_status == 1)
                                                <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                                            @elseif($item_theloai->theloai_status == 0)
                                                <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex_center icons">
                                                <div class="icon bg-bule flex_center">
                                                    <a href="{{ route('theloai_update', ['theloai_id' => $item_theloai->theloai_id]) }}">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="icon bg-red flex_center">
                                                    @if ($item_theloai->theloai_status == 1)
                                                        <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái tắt không?')"
                                                            href="{{ route('togggle_status_theloai', ['theloai_id' => $item_theloai->theloai_id, 'theloai_status' => 1]) }}">
                                                            <i class="fa-solid fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái bật không ?')"
                                                            href="{{ route('togggle_status_theloai', ['theloai_id' => $item_theloai->theloai_id, 'theloai_status' => 0]) }}">
                                                            <i class="fa-solid fa-toggle-off"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        @if ($list_theloai->total() > $list_theloai->perPage())
                                            <div class="pagination">
                                                <ul class="pagination">
                                                    <!-- Nút Previous -->
                                                    @if ($list_theloai->currentPage() > 1)
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_theloai->previousPageUrl() }}" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    @endif
                            
                                                    <!-- Các trang -->
                                                    @for ($i = 1; $i <= $list_theloai->lastPage(); $i++)
                                                        <li class="page-item{{ ($list_theloai->currentPage() == $i) ? ' active' : '' }}">
                                                            <a class="page-link" href="{{ $list_theloai->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endfor
                            
                                                    <!-- Nút Next -->
                                                    @if ($list_theloai->currentPage() < $list_theloai->lastPage())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_theloai->nextPageUrl() }}" aria-label="Next">
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
