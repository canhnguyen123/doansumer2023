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
                    
                </div>
            </div>
            <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
                <input type="text" id="search_ajax_user" class="search-input" placeholder="Nhập thông tin cần tìm">
                <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
                <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none" id="close_search"></i>
            </div>
            <div class="col-12 mg-20 data-fiter row" style="display: none">
                <div class="col-12 row">
                    <div class="col-4 fiter">
                        <label for="">Trạng thái
                            <i class="fa-solid fa-thumbs-up bg-cl-green mg-10-l check-status" id="like-up"
                                onclick="openThumdown()"></i>
                            <i class="fa-solid fa-thumbs-down bg-cl-red mg-10-l check-status" id="like-down"
                                onclick="openThumup()" style="display: none"></i>
                        </label>
                        <select name="" id="user-status-fiter">
                            <option value="all">Tất cả</option>
                            <option value="1">Đang bật</option>
                            <option value="0">Đang tắt</option>
                        </select>
                    </div>
                    <div class="col-4 fiter">
                        <label for="">Thể loại tài khoản</label>
                        <select name="" id="category-user-fiter">
                            <option value="all">Tất cả tài khoản</option>
                            <option value="1">Tài khoản bình thường</option>
                            <option value="2">Tài khoản facebook</option>
                            <option value="3">Tài khoản googel</option>
                        </select>
                    </div>
                    <div class="col-4 ip-form flex_center">
                        <button class="koew" onclick="fiter_data_user()">Lọc</button>
                    </div>
                </div>
            </div>




            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Quản lý người dùng
                    </div>
                    <div class="col-12">
                        <table id="userTable" class="table" ui-jq="footable"
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
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Số điện thoại</th>
                                    <th>Thể loại tài khoản</th>
                                    <th style="text-align: center;">Tình trạng</th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="user_list_table">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($list_user as $key => $item_user)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr data-expanded="true">
                                        <td>{{ $i }}</td>
                                        <td>{{ $item_user->user_fullname }}</td>
                                        <td>{{ $item_user->user_phone }}</td>
                                        <td>
                                            @if ( $item_user->user_accountCategory==1)
                                                Tài khoản bình thường
                                            @elseif ( $item_user->user_accountCategory==2)
                                                Tài khoản facebook
                                            @elseif ( $item_user->user_accountCategory==3)
                                                Tài khoản google    
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item_user->user_status==1)
                                            
                                            <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                                            @elseif($item_user->user_status==0)
                                            <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex_center icons">
                                                <div class="icon bg-yellow flex_center">
                                                    <a href="{{ route('user_deatil', ['user_id' => $item_user->user_id]) }}"><i
                                                            class="fa-solid fa-eye"></i></a>
                                                </div>
                                                <div class="icon bg-red flex_center">
                                                    @if ($item_user->user_status == 1)
                                                        <a onclick="return confirm('Bạn có muốn bỏ khóa tài khoản  này không?')"
                                                            href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id, 'user_status' => 1]) }}"><i
                                                                class="fa-solid fa-toggle-on"></i></a>
                                                    @else
                                                        <a onclick="return confirm('Bạn có muốn tạm khóa tài khoản  này  không ?')"
                                                            href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id, 'user_status' => 0]) }}"><i
                                                                class="fa-solid fa-toggle-off"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            <tfoot id="default_pagination">
                                <tr>
                                    <td colspan="6">
                                        @if ($list_user->total() > $list_user->perPage())
                                            <div class="pagination">
                                                <ul class="pagination">
                                                    <!-- Nút Previous -->
                                                    @if ($list_user->currentPage() > 1)
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_user->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <!-- Các trang -->
                                                    @for ($i = 1; $i <= $list_user->lastPage(); $i++)
                                                        <li
                                                            class="page-item{{ $list_user->currentPage() == $i ? ' active' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $list_user->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endfor
                                                    <!-- Nút Next -->
                                                    @if ($list_user->currentPage() < $list_user->lastPage())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_user->nextPageUrl() }}"
                                                                aria-label="Next">
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

                            </tbody>
                        </table>

                        <div class="load-more flex_center">
                         
                             <button id="load-more-user"class="btn-loadmore" style="display: none">Xem thêm</button>
                         
                        </div>

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
