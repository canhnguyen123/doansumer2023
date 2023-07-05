@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="form-fiter row">
                <div class="col-6 left">
                    <h3>Tổng số sản phẩm :{{ $count }} </h3>
                </div>
                <div class="col-6 right">
                    <div class="search_icon icon flex_center fiter-toggle bg-bule" id="fiter_icon">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                    <div class="search_icon icon flex_center bg-bule" id="search_icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="search_icon icon flex_center add-icon bg-bule">
                        <a href="{{ route('product_add') }}"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
                <input type="text" id="search_ajax_product" placeholder="Nhập thông tin cần tìm">
                <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
                <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none" id="close_search"></i>
            </div>
            <div class="col-12 mg-20 data-fiter row" style="display: none">
                <div class="col-3 fiter">
                    <label for="">Trạng thái</label>
                    <select name="" id="product-status-fiter">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>
                <div class="col-3 fiter">
                    <label for="">Danh mục</label>
                    <select name="" id="product-status-fiter">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>
                <div class="col-3 fiter">
                    <label for="">Phân loại</label>
                    <select name="" id="product-status-fiter">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>
                <div class="col-3 fiter">
                    <label for="">Thể loại</label>
                    <select name="" id="product-status-fiter">
                        <option value="all">Tất cả</option>
                        <option value="1">Đang bật</option>
                        <option value="0">Đang tắt</option>
                    </select>
                </div>

            </div>
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Quản lý sản phẩm
                    </div>
                    <div class="col-12">
                        <table id="productTable" class="table" ui-jq="footable"
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
                                    <th>Tên thể loại</th>
                                    <th colspan="2">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th class="flex_center ">

                                        Trạng thái
                    </div>

                    </th>
                    <th style="text-align: center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody id="product_list_table">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($list_product as $key => $item_product)
                            @php
                                $i++;
                            @endphp
                            <tr data-expanded="true">
                                <td>{{ $i }}</td>
                                <td>{{ $item_product->theloai_name }}</td>
                                <td colspan="2">{{ $item_product->product_name }}</td>
                                <td>{{ $item_product->product_price }}</td>
                                <td style="text-align: center">
                                    <p class="reslut_categgory_icon" style="display: none">
                                        {{ $item_product->product_status }}</p>
                                    @if ($item_product->product_status == 1)
                                        <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                                    @elseif($item_product->product_status == 0)
                                        <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex_center icons">
                                        <div class="icon bg-yellow flex_center">
                                            <a
                                                href="{{ route('product_deatil', ['product_id' => $item_product->product_id]) }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                        <div class="icon bg-bule flex_center">
                                            <a
                                                href="{{ route('product_update', ['product_id' => $item_product->product_id]) }}">
                                                <i class="fa-solid fa-pen"></i></a>
                                        </div>
                                        <div class="icon bg-red flex_center">
                                            @if ($item_product->product_status == 1)
                                                <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái tắt không?')"
                                                    href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 1]) }}"><i
                                                        class="fa-solid fa-toggle-on"></i></a>
                                            @else
                                                <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái bật không ?')"
                                                    href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 0]) }}"><i
                                                        class="fa-solid fa-toggle-off"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
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
