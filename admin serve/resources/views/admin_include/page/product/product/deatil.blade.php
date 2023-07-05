@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading flex_center" id="upload-status">
                    <h2 class="titel-ic"> Chi tiết sản phẩm</h2>   
                    </div>
                    <div class="content col-12 ">

                    </div>
                    @foreach ($product_detail as $item_deatil)
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
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Danh mục :</label>
                                        {{ $item_deatil->category_name }}</p>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Phân loại :</label>
                                        {{ $item_deatil->phanloai_name }}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Thể loại :</label>
                                        {{ $item_deatil->theloai_name }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Tên sản phẩm :</label>
                                        {{ $item_deatil->product_name }}</p>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Mã sản phẩm :</label>
                                        {{ $item_deatil->product_code }}</p>
                                </div>

                            </div>


                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Thương hiệu :</label>
                                        {{ $item_deatil->product_brand }}</p>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Trạng thái sản phẩm :</label>
                                        {{ $item_deatil->product_status_Ha }}
                                    </p>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <label for="">Giá sản phẩm :</label>
                                    <p class="context-deatil">{{ $item_deatil->product_price }}</p>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Trạng thái :</label>
                                        @if ($item_deatil->product_status == 0)
                                            Đang tắt <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
                                        @else
                                            Đăng bật <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
                                        @endif
                                    </p>
                                </div>

                            </div>
                            <div class="col-12 title-product-deatil">
                                <h3>Số lượng theo size và màu sắc</h3>
                            </div>
                            <div class="col-12 res-them">
                                @foreach ($product_deatil_quantity as $item_quantity)
                                    <div class="item-req">
                                        <div class="item-res-pro">
                                            <p>Color</p>: <p>{{$item_quantity->quantity_color}} </p>
                                        </div>
                                        <div class="item-res-pro">
                                            <p>size</p>: <p class="size-item-Pro">{{$item_quantity->quantity_size}}</p>
                                        </div>
                                        <div class="item-res-pro">
                                            <p>SL</p>: <p class="quantyti-item-Pro">{{$item_quantity->quantity_sl}}</p>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="btn-asd flex_center asd-pre"><i class="fa-solid fa-left-long"></i></div>
                                <div class="btn-asd flex_center asd-next"><i class="fa-solid fa-right-long"></i></div> --}}
                            </div>
                            <div class="col-12 tabs">
                                <div class="tab-item active">Mô tả</div>
                                <div class="tab-item">Đặc điểm</div>
                                <div class="tab-item">Bảo quản</div>
                                <div class="line"></div>
                            </div>
                            <div class="col-12 tab-content">
                                <div class="tab-pane active">
                                    <p class="tctx-p">{{$item_deatil->product_mota}}</p>
                                </div>
                                <div class="tab-pane">
                                    <p>{{$item_deatil->product_dacdiem}}</p> </div>
                                <div class="tab-pane">
                                    <p>{{$item_deatil->product_baoquan}}</p>   </div>
                            </div>
                         
                        </div>
                    @endforeach

                </div>
            </div>

        </section>

    </section>
@endsection