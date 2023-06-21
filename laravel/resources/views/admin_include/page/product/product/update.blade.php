@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading" id="upload-status">
                       Cập nhật thông tin  sản phẩm
                    </div>
                    <div class="content col-12 ">

                    </div>
                    @foreach ($select_product as $item_product)
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
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                
                                <div class="carousel-inner">
                           @foreach ($product_deatil_img as $index => $item_img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                                    <img src="{{ $item_img->img_name }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <h5 style="color: white">Ảnh thứ {{ $index + 1 }}</h5>
                                  
                                    </div>
                                </div>
                                @endforeach
                                 
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                        <div class="col-8 row">
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Danh mục</label>
                                    <select name="category_code" id="category_id_Pro">
                                        <option value="{{ $item_product->category_id }}">
                                            {{ $item_product->category_name }}</option>
                                           
                                        @foreach ($list_category as $key => $item_category)
                                        @if ($item_product->category_code!=$item_category->category_id)
                                                <option value="{{ $item_category->category_id }}">
                                                {{ $item_category->category_name }}</option>
                                        @endif
                                            
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Phân loại</label>
                                    <select name="phanloai_code" id="phanloai_id_Pro">
                                        <option value="{{ $item_product->phanloai_id }}">
                                            {{ $item_product->phanloai_name }}</option>
                                        @foreach ($list_phanloai as $key => $item_phanloai)
                                            @if ($item_product->phanloai_id !=$item_phanloai->phanloai_id)
                                                 <option value="{{ $item_phanloai->phanloai_id }}">
                                                {{ $item_phanloai->phanloai_name }}</option>
                                            @endif
                                           
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                
                                    <label for="">Thể loại</label>
                                    <select name="phanloai_code" id="theloai_id">
                                        <option value="{{ $item_product->theloai_id }}">
                                            {{ $item_product->theloai_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                   
                                    <input type="text" name="product_name" value=" {{$item_product->product_name}}" id="product_name" required>
                                    <label for="">Tên sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form ip-form-lb-i">
                                    
                                    <input type="text" id="product_code" value=" {{$item_product->product_code}}"  required >
                                    <label for="">Mã sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form ip-form-lb-i">
                                  
                                    <input type="text" name="" id="product_price" value=" {{$item_product->product_price}}"  required>
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
                            <div class="col-12 res-them">
                                @foreach ($product_deatil_quantity as $item_quantity)
                                <div class="item-req">
                                    <div class="item-res-pro">
                                        <p>Color</p>: <p id="item-res-color-Pro">{{$item_quantity->quantity_color}} </p>
                                    </div>
                                    <div class="item-res-pro">
                                        <p>size</p>: <p id="item-res-size-Pro" class="size-item-Pro">{{$item_quantity->quantity_size}}</p>
                                    </div>
                                    <div class="item-res-pro">
                                        <p>SL</p>: <p id="item-res-quantity-Pro" class="quantyti-item-Pro">{{$item_quantity->quantity_sl}}</p>
                                    </div>
                                    <div class="item-icon">
                                        <i onclick="select_quantity()" class="fa-solid fa-pen"></i>
                                        <i onclick="deleteQuantity({{$item_quantity->quantity_id}}, {{$item_product->product_id}})" class="fa-sharp fa-solid fa-trash"></i>
                                    </div>
                                </div>
                            @endforeach
                                {{-- <div class="btn-asd flex_center asd-pre"><i class="fa-solid fa-left-long"></i></div>
                                <div class="btn-asd flex_center asd-next"><i class="fa-solid fa-right-long"></i></div> --}}
                            </div>
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
                                    <textarea id="mota_product" cols="30" rows="10" class="editor" name="" required> {{$item_product->product_mota}} </textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="dacdiem_product" cols="30" rows="10" class="editor" name="" required>{{$item_product->product_dacdiem}}</textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="baoquan_product" cols="30" rows="10" class="editor" name="" required>{{$item_product->product_baoquan}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 ip-form">
                                    <button  id=""  onclick="uploadImage_Product(event)"  name=""><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật sản phẩm</button>
                                {{-- <button  id=""  type="submit" name=""><i class="fa-sharp fa-solid fa-plus"></i> Thêm thể loại</button> --}}

                            </div>
                        </div>

                    </form>
                    @endforeach
                 
                </div>
            </div>

        </section>

    </section>
@endsection
