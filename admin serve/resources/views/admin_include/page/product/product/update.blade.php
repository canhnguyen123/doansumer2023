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
                    <form action="{{ route('post_product_update',['product_id'=> $item_product->product_id])}}" method="post" class="row ">
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
                        <div class="col-12 row">
                            <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Danh mục</label>
                                    <select name="category_code_up" id="category_id_Pro">
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
                                    <select name="phanloai_code_up" id="theloai_id">
                                        <option value="{{ $item_product->theloai_id }}">
                                            {{ $item_product->theloai_name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                   
                                    <input type="text" name="product_name_up" value=" {{$item_product->product_name}}" id="product_name" required>
                                    <label for="">Tên sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                    
                                    <input type="text" id="product_code" name="product_code_up" value=" {{$item_product->product_code}}"  required >
                                    <label for="">Mã sản phẩm</label>
                                </div>
                               
                            </div>
                            <div class="col-6 err-product"></div>
                            <div class="col-3 err-product"></div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                  
                                    <input type="text" name="product_priceIn_up" id="product_price" value=" {{$item_product->product_priceIn}}"  required>
                                    <label for="" id="product_price_lable">Giá nhập sản phẩm</label>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form ip-form-lb-i">
                                  
                                    <input type="text" name="product_price_up" id="product_price" value=" {{$item_product->product_price}}"  required>
                                    <label for="" id="product_price_lable">Giá sản phẩm</label>
                                </div>

                            </div>
                          
                            <div class="col-6 err-product"><span  id="err-product-price"></span></div>
                            <div class="col-6 err-product"><span  id="err-product-price"></span></div>
                            <div class="col-6">
                                <div class="col-12 ip-form">
                                    <label for="">Thương hiệu</label>
                                    <select name="brand_name_up" id="brand_Product">
                                        @foreach ($list_brand as $key => $item_brand)
                                            <option value="{{ $item_brand->brand_name }}">{{ $item_brand->brand_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form">
                                    <label for="">Trạng thái</label>
                                    <select name="status_product_up" id="trangthai_Product">
                                        @foreach ($list_status_product as $key => $item_status_Pro)
                                            <option value="{{ $item_status_Pro->status_name }}">
                                                {{ $item_status_Pro->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-4">
                                <div class="col-12 ip-form">
                                    <label for="">Ảnh đại diện</label>
                                    <input type="file" id="file-upload-product" class="bder-none file-upload"
                                        value="" multiple required>
                                </div>
                            </div> --}}
                            <div class="col-12 tabs">
                                <div class="tab-item active">Mô tả</div>
                                <div class="tab-item">Đặc điểm</div>
                                <div class="tab-item">Bảo quản</div>
                                <div class="line"></div>
                            </div>
                            <div class="col-12 tab-content">
                                <div class="tab-pane active">
                                    <textarea id="mota_product" cols="30" rows="10" class="editor" name="mota_product_up" required> {{$item_product->product_mota}} </textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="dacdiem_product" cols="30" rows="10" class="editor" name="dacdiem_product_up" required>{{$item_product->product_dacdiem}}</textarea>
                                </div>
                                <div class="tab-pane">
                                    <textarea id="baoquan_product" cols="30" rows="10" class="editor" name="baoquan_product_up" required>{{$item_product->product_baoquan}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 ip-form" style="display: flex">
                                     <button type="submit"><i class="fa-solid fa-pen-to-square"></i> Cập nhật sản phẩm</button>
                                     <a class="" href="{{route('quantityProduct_list',['product_id'=>$item_product->product_id])}}">  <div class="link-btn flex_center" style="background-color: #d84a38"><p>Cập nhật số lượng</p>  </div>  </a>
                                     <a class="" href="{{route('ImgProduct_list',['product_id'=>$item_product->product_id])}}">  <div class="link-btn flex_center" style="background-color: #FCB322"><p>Cập nhật hình ảnh</p>  </div>  </a>
                            </div>
                        </div>

                    </form>
                    @endforeach
                 
                </div>
            </div>

        </section>

    </section>
@endsection
