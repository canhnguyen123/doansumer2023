@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading" id="upload-status">
                        Thêm mới sản phẩm
                    </div>
                    <div class="content col-12 ">

                    </div>
                    <form action="{{ route('post_product_add')}}" method="post" class="row ">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        <div class="col-4 slider-product">
                            <div class="slider">
                                <img class="product-img-class"
                                    src="https://down-vn.img.susercontent.com/file/sg-11134201-23010-2s1fbeyjcxmv9f"
                                    alt="">
                                <!-- Thẻ div chứa ảnh sẽ được sinh ra từ quá trình tải lên -->
                            </div>
                            <div class="slider-controls">
                                <div class="prev icon-class flex_center"><i class="fa-solid fa-arrow-left"></i></div>
                                <div class="next icon-class flex_center"><i class="fa-solid fa-arrow-right"></i></div>
                            </div>
                        </div>
                        <div class="col-8 row">
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Danh mục</label>
                                    <select name="category_code" id="category_id_Pro">
                                        @foreach ($list_category as $key => $item_category)
                                            <option value="{{ $item_category->category_id }}">
                                                {{ $item_category->category_name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Phân loại</label>
                                    <select name="phanloai_code" id="phanloai_id_Pro">
                                        @foreach ($list_phanloai as $key => $item_phanloai)
                                            <option value="{{ $item_phanloai->phanloai_id }}">
                                                {{ $item_phanloai->phanloai_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Thể loại</label>
                                    <select name="phanloai_code" id="theloai_id">
                                    <option value="">Chọn thể loại</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                   
                                    <input type="text" name="product_name" id="product_name" required>
                                    <label for="">Tên sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form ip-form-lb-i">
                                    
                                    <input type="text" class="viethoa" id="product_code" required >
                                    <label for="">Mã sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form ip-form-lb-i">
                                  
                                    <input type="text" name="" id="product_price" required>
                                    <label for="" id="product_price_lable">Giá sản phẩm</label>
                                </div>

                            </div>
                            <div class="col-6 err-product"></div>
                            <div class="col-3 err-product"></div>
                            <div class="col-3 err-product"><span  id="err-product-price"></span></div>
                            <div class="col-12 row mg-10">
                                <label for="">Size</label>
                                <div class="item-list-size">
                                    @foreach ($list_size as $index=> $item_size)
                                        <div class="mg-r-l-10px ">
                                            <label class="ip-csr" for="">{{ $item_size->name_size }}</label>
                                            <input type="radio" name="product-size-item" id="product-size-item" value="{{ $item_size->name_size }}"  @if ($index === 0) checked @endif><br>
                                             </div>
                                    @endforeach

                                </div>

                            </div>
                            <div class="col-12 row mg-10">
                                <label for="">Màu sắc</label>
                                <div class="item-list-size">
                                  @foreach ($list_color as $index => $item_color)
                                    <div class="mg-r-l-10px">
                                      <label class="ip-csr" for="">{{ $item_color->color_name }}</label>
                                      <input type="radio" id="product-color-item" name="product-color-item" value="{{ $item_color->color_name }}" @if ($index === 0) checked @endif><br>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            <div class="col-4 row mg-10">
                                <div class="col-12 ip-form input-lable-form">
                                    <input type="text" id="quantityItem" value="1" required>
                                    <label for="">Nhập số lượng</label>
                                </div>
                                
                            </div>
                            <div class="col-8 input-lable-form">
                                <button onclick="them_slPRo(event)">Thêm</button>
                            </div>
                            <div class="col-12 res-them"></div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Thương hiệu</label>
                                    <select name="category_code" id="brand_Product">
                                        @foreach ($list_brand as $key => $item_brand)
                                            <option value="{{ $item_brand->brand_name }}">{{ $item_brand->brand_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Trạng thái</label>
                                    <select name="phanloai_code" id="trangthai_Product">
                                        @foreach ($list_status_product as $key => $item_status_Pro)
                                            <option value="{{ $item_status_Pro->status_name }}">
                                                {{ $item_status_Pro->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Ảnh đại diện</label>
                                    <input type="file" id="file-upload-product" class="bder-none file-upload"
                                        value="" multiple required>
                                </div>
                            </div>
                            <div class="col-12 tabs">
                                <div class="tab-item active">Mô tả</div>
                                <div class="tab-item">Đặc điểm</div>
                                <div class="tab-item">Bảo quản</div>
                                <div class="line"></div>
                            </div>
                            <div class="col-12 tab-content">
                                <div class="tab-pane active">
                                    <textarea id="mota_product" cols="30" rows="10" class="editor" name="" required></textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="dacdiem_product" cols="30" rows="10" class="editor" name="" required></textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="baoquan_product" cols="30" rows="10" class="editor" name="" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 ip-form" style="display: flex">
                                    <button onclick="uploadImage_Product(event)"><i class="fa-sharp fa-solid fa-plus"></i> Thêm thể loại</button>
                                    <a href="{{route('product_list')}}" class="link-btn-add-form "><div class="btn-add-form flex_center"><i class="fa-solid fa-arrow-rotate-left"></i> Quay lại</div></a>

                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </section>

    </section>
@endsection
