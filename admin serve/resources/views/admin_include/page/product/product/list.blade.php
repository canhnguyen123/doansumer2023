@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="form-fiter row">
                <div class="col-6 left">
                    <h3>Tổng số sản phẩm :{{ $count }} </h3>
                </div>
                <div class="col-6 right">
                    <div class="search_icon icon flex_center  bg-red-blink" onclick="realoadProduct()" id="loadProduct">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </div>
                    <div class="search_icon icon flex_center fiter-toggle bg-yellow-og" id="fiter_icon">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                    <div class="search_icon icon flex_center bg-yellow-green" id="search_icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="search_icon icon flex_center add-icon bg-bule">
                        <a href="{{ route('product_add') }}"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 input-search mg-20" style="display: none;" id="search_input">
                <input type="text" id="search_ajax_product" class="search-input" placeholder="Nhập thông tin cần tìm">
                <i class="fa-sharp fa-solid fa-magnifying-glass  icon-search-form"></i>
                <i class="fa-sharp fa-regular fa-xmark close icon-close-form" style="display: none" id="close_search"></i>
            </div>
            <div class="col-12 mg-20 data-fiter row" style="display: none">
                <div class="col-12 row">
                    <div class="col-3 fiter">
                        <label for="">Trạng thái
                            <i class="fa-solid fa-thumbs-up bg-cl-green mg-10-l check-status" id="like-up"
                                onclick="openThumdown()"></i>
                            <i class="fa-solid fa-thumbs-down bg-cl-red mg-10-l check-status" id="like-down"
                                onclick="openThumup()" style="display: none"></i>
                        </label>
                        <select name="" id="product-status-fiter">
                            <option value="all">Tất cả</option>
                            <option value="1">Đang bật</option>
                            <option value="0">Đang tắt</option>
                        </select>
                    </div>
                    <div class="col-3 fiter">
                        <label for="">Danh mục</label>
                        <select name="" id="category_id_Pro">
                            @foreach ($list_category as $item_category)
                                <option value="{{ $item_category->category_id }}">{{ $item_category->category_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-3 fiter">
                        <label for="">Phân loại</label>
                        <select name="" id="phanloai_id_Pro">
                            @foreach ($list_phanloai as $item_phanloai)
                                <option value="{{ $item_phanloai->phanloai_id }}">{{ $item_phanloai->phanloai_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 fiter">
                        <label for="">Thể loại</label>
                        <select name="" id="theloai_id">
                        </select>
                    </div>

                </div>
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
                                    <input type="text" class="span-text" id="slider-range-value1">
                                    </span>
                                </div>
                                <div class="col-6 text-right caption">
                                    <strong>Max:</strong>
                                    {{-- <span id="slider-range-value2"> --}}
                                    <input type="text" class="span-text" id="slider-range-value2">
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
                        <select name="" class="koew" id="is-fiter-data">
                            <option value="1">Có lọc giá</option>
                            <option value="0">Không lọc giá</option>
                        </select>
                        <button class="koew" onclick="fiter_data_product()">Lọc</button>
                    </div>
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
                            <thead class="table-dark">
                                <tr>
                                    <th data-breakpoints="xs">STT</th>
                                    <th>Tên thể loại</th>
                                    <th colspan="2">Tên sản phẩm</th>
                                   
                                    <th class="flex_center "> Trạng thái </th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="product_list_table">
                                @php
                                    $i = ($list_product->currentPage() - 1) * $list_product->perPage() + 1;
                                @endphp
                                @foreach ($list_product as $key => $item_product)
                                    <tr data-expanded="true">
                                        <td>{{ $i }}</td>
                                        <td>{{ $item_product->theloai_name }}</td>
                                        <td colspan="2">{{ $item_product->product_name }}   ({{number_format($item_product->product_price, 0, ',', ' ') }} VNĐ)</td>
                                       
                                        <td style="text-align: center">
                                            <p class="reslut_categgory_icon" style="display: none">
                                                {{ $item_product->product_status }}
                                            </p>
                                            @if ($item_product->product_status == 1)
                                                <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                                            @elseif($item_product->product_status == 0)
                                                <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex_center icons">
                                                <div class="icon bg-yellow flex_center">
                                                    <a href="{{ route('product_deatil', ['product_id' => $item_product->product_id]) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class=" bg-bule flex_center icon">
                                                    <a href="{{ route('product_update', ['product_id' => $item_product->product_id]) }}">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class=" bg-red flex_center icon">
                                                    @if ($item_product->product_status == 1)
                                                        <a onclick="return confirm('Bạn có muốn chuyển sản phẩm này sang trạng thái tắt không?')"
                                                            href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 1]) }}">
                                                            <i class="fa-solid fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a onclick="return confirm('Bạn có muốn chuyển sản phẩm này sang trạng thái bật không ?')"
                                                            href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 0]) }}">
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
                                        @if ($list_product->total() > $list_product->perPage())
                                            <div class="pagination">
                                                <ul class="pagination">
                                                    <!-- Nút Previous -->
                                                    @if ($list_product->currentPage() > 1)
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_product->previousPageUrl() }}" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    @endif
                            
                                                    <!-- Các trang -->
                                                    @for ($i = 1; $i <= $list_product->lastPage(); $i++)
                                                        <li class="page-item{{ ($list_product->currentPage() == $i) ? ' active' : '' }}">
                                                            <a class="page-link" href="{{ $list_product->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endfor
                            
                                                    <!-- Nút Next -->
                                                    @if ($list_product->currentPage() < $list_product->lastPage())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $list_product->nextPageUrl() }}" aria-label="Next">
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
