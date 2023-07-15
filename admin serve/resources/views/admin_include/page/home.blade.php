@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <!-- //market-->
            <div class="market-updates col-12">
                <div class="col-md-3 market-update-gd">
                    <div class="market-update-block clr-block-2">
                        <div class="col-md-4 market-update-right">
                            <i class="fa fa-eye"> </i>
                        </div>
                        <div class="col-md-8 market-update-left">
                            <h4>Số lượt truy cập hôm nay</h4>
                            <h3>13,500</h3>
                            <p>Lượt truy cập</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-3 market-update-gd">
                    <div class="market-update-block clr-block-1">
                        <div class="col-md-4 market-update-right">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="col-md-8 market-update-left">
                            <h4>Số người dăng kí mới</h4>
                            <h3>1,250</h3>
                            <p>Lượt truy cập</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-3 market-update-gd">
                    <div class="market-update-block clr-block-3">
                        <div class="col-md-4 market-update-right">
                            <i class="fa fa-usd"></i>
                        </div>
                        <div class="col-md-8 market-update-left">
                            <h4>Số lượt bình luận mới</h4>
                            <h3>1,550 </h3>
                            <p>Lượt bình luận</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-3 market-update-gd">
                    <div class="market-update-block clr-block-4">
                        <div class="col-md-4 market-update-right">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-8 market-update-left">
                            <h4>Số đơn mới hôm nay</h4>
                            <h3>100</h3>
                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
           
            <div class="col-12 titel-header flex_center">
                <h4>Banner mới nhât</h4>
            </div>
            <div class="col-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($list_banner as $item_banner)
                            <div class="swiper-slide">
                                <img src="{{ $item_banner->banner_link }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="col-12 titel-header flex_center ">
                <h4 class="titel-f-25">Hiển thị các thể loại hiển thị ở trang chủ trên app <i
                        class="fa-solid fa-pencil"></i></h4>
            </div>
            @if ($count_theloai>=4)
            <div class="col-12 flex_center">
                <small>Lưu lý bạn đã hiển thị {{$count_theloai}}/3 giới hạn là 4 thể loại hiển thị ở trang chủ</small>
            </div>
            @endif
           
            <div class="col-12 row">
                <form action="{{route('updateShowHome')}}" method="post" class="row">
                    @csrf
                    <div class="col-10 theloai-check">
                        @foreach ($theloai as $itemtheloai)
                            <div class="item-theloai-check">
                                @if ($itemtheloai->show_home == 1)
                                    <input type="checkbox" name="theloaiItem[]" value="{{ $itemtheloai->theloai_id}}" checked />
                                    {{ $itemtheloai->theloai_name }}
                                @else
                                    <input type="checkbox" name="theloaiItem[]" value="{{ $itemtheloai->theloai_id}}" />
                                    {{ $itemtheloai->theloai_name }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col-2 update-button">
                        <button type="submit">Cập nhật</button>
                    </div>
                </form>

            </div>

        </section>
    </section>
@endsection
