@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading flex_center" id="upload-status">
                    <h2 class="titel-ic"> Chi tiết sản phẩm</h2>   
                    </div>
                    <div class="content col-12 row">
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
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Danh mục :</label>
                                        {{ $item_deatil->category_name }}</p>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil"> <label for="">Phân loại :</label>
                                        {{ $item_deatil->phanloai_name }}</p>
                                </div>
                            </div>
                            <div class="col-6">
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
                                        <label for="">Giá bán :</label>
                                         {{number_format( $item_deatil->product_price, 0, ',', ' ') }} VNĐ
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Giá nhập :</label>
                                        {{number_format( $item_deatil->product_priceIn, 0, ',', ' ') }} VNĐ
                                    </p>
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
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($product_deatil_quantity as $item_quantity)
                                    <div class="item-req">
                                        <div class="item-res-pro">
                                            <p>Color</p>: <p class="size-color-Pro">{{$item_quantity->quantity_color}} </p>
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
                            <div class="col-6">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Tổng số lượng hàng :</label>
                                       <p class="text-quantity"></p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Tổng size :</label>
                                       <p class="text-size"></p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-12 ip-form flex_ mg-20">
                                    <p class="context-deatil">
                                        <label for="">Tổng màu :</label>
                                       <p class="text-color"></p>
                                    </p>
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
                                    {!! htmlspecialchars_decode($item_deatil->product_mota) !!}
                                </div>
                                <div class="tab-pane">
                                    {!! htmlspecialchars_decode($item_deatil->product_dacdiem) !!}
                                </div>
                                <div class="tab-pane">
                                    {!! htmlspecialchars_decode($item_deatil->product_baoquan) !!}
                                </div>
                         
                        </div>
                    @endforeach
                    </div>
                    <div class="col-12 selec-commet">
                        <div class="content-list-commet">
                            @foreach ($list_cmt as $item_cmt)
                            <div class="item-commet">
                                <a href="{{route('user_deatil',['user_id'=>$item_cmt->user_id])}}">
                                    <div class="img-user flex_center">
                                        <img src="
                                        @if ($item_cmt->user_img=="")
                                        https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/c6e56503cfdd87da299f72dc416023d4.jpg?alt=media&token=0f06f1ca-d5a1-48e8-a8e7-704fdca9f927
                                        @else
                                            {{$item_cmt->user_img}}
                                        @endif
                                        " alt="">
                                    </div>
                                </a>
                               
                                <div class="infro-user">
                                   <div class="content-cmt">
                                        <a href="{{route('user_deatil',['user_id'=>$item_cmt->user_id])}}"><div class="infro-user-name">{{$item_cmt->user_fullname}}</div></a>
                                        <div class="infro-user-text">{{$item_cmt->cmt_text}}</div>
                                   </div>
                                </div>
                            </div>
                            @endforeach
                         
                        </div>
                        
                        <div class="post-commet flex_center">
                            <form action="" method="post" class="flex_center">
                                <input type="text" placeholder="Nhập nội dung bình luận" required> 
                                <button>Bình luận</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </section>

    </section>
@endsection
