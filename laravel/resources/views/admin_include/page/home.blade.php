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
                            <h4>Số đơn  mới hôm nay</h4>
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
							<img src="{{$item_banner->banner_link}}" alt="">
						</div>
						@endforeach
						</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-pagination"></div>
				  </div>
			</div>
			{{-- <div class="col-12 titel-header flex_center">
				<h4>Voucher mới nhât</h4>
			</div> --}}
		
        </section>
    </section>
@endsection
