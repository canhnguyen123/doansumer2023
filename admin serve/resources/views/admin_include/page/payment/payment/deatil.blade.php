@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Hóa đơn chi tiết
                    </div>
                    @foreach ($hoadon_deatil as $item_payment)
                        <div class="content col-12 ">
                            @if ($item_payment->status_payment_id == 1)
                                <form class="row" action="{{ route('post_bill_add',['hoadon_id'=>$item_payment->hoadon_id]) }}" method="POST">
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
                                    <div class="col-6">
                                        <div class="col-12 ip-form">
                                            <label>Cập nhật trạng thái đơn hàng</label>
                                            <select name="payment_status" id="status-select">
                                                <option value="2">Xác nhận giao hàng</option>
                                                <option value="5">xác nhận k tạo đơn</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-6" id="code-block">
                                        <div class="col-12 ip-form">
                                            <label>Mã mã code cho hóa đơn</label>
                                            <input type="text" name="payment_code" value=""><br>
                                        </div>
                                        <div class="col-12 err"><span>
                                                @error('category_code')
                                                    {{ $message }}
                                                @enderror
                                                @if (session('errorMessage'))
                                                    {{ session('errorMessage') }}
                                                @endif
                                            </span></div>
                                    </div>

                                    <div class="col-12 ip-form">
                                        <button type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Thêm tạo mã
                                            code</button>
                                    </div>

                                </form>
                                @elseif ($item_payment->status_payment_id == 2)
                                <form class="row" action="{{ route('post_bill_add',['hoadon_id'=>$item_payment->hoadon_id]) }}" method="POST">
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
                                    <div class="col-8 ip-form flex_center ip-status-2">
                                        <label for="delivery">Chuyển cho đơn vị giao hàng </label>
                                        <input type="checkbox" name="" id="delivery" class="switch-toogel">
                                        <label for="cancel">Hủy không chuyển nữa</label>
                                        <input type="hidden" name="payment_status" id="paymentStatus" value="3">
                                    </div>
                                    <div class="col-4 ip-form"> <button type="submit"> Xác nhận </button> </div>
                                </div>
                               </form>
                               @elseif ($item_payment->status_payment_id == 3)
                               <form class="row" action="{{ route('post_bill_add',['hoadon_id'=>$item_payment->hoadon_id]) }}" method="POST">
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
                                   <div class="col-8 ip-form flex_center ip-status-2">
                                       <label for="delivery">Xác nhận giao thành công </label>
                                       <input type="checkbox" name="" id="delivery" class="switch-toogel">
                                       <label for="cancel">Giao thất bại</label>
                                       <input type="hidden" name="payment_status" id="paymentStatus" value="4">
                                   </div>
                                   <div class="col-4 ip-form"> <button type="submit">Cập nhật</button> </div>
                               </div>
                              </form>
                                @endif

                        </div>
                        <div class="col-12 row mg-40">
                            <div class="col-6 ip-form">
                                <p><i class="fa-solid fa-user"></i> <label>Tên người dùng</label> :
                                    {{ $item_payment->user_fullname}}</p>
                            </div>
                            <div class="col-6 ip-form">
                                <p><i class="fa-solid fa-phone"></i> <label>Số điện thoại</label> :
                                    {{ $item_payment->user_phone}}</p>
                            </div>
                            <div class="col-6 ip-form">
                                <p><i class="fa-brands fa-codepen"></i> <label>Mã hóa đơn</label> :
                                    @if ($item_payment->hoadon_code=="")
                                        Chưa xác nhận tạo hóa đơn
                                    @else
                                        {{$item_payment->hoadon_code}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-6 ip-form">
                                <p><i class="fa-solid fa-money-bill"></i> <label>Tổng số tiền</label> :
                                    {{ number_format($item_payment->hoadon_allprice, 0, '.', ',') }} VNĐ
                                </p>
                            </div>
                            <div class="col-12 row">
                                @if ($item_payment->voucher_id==1)
                                <div class="col-6 ip-form">
                                    <p><i class="fa-solid fa-tag"></i> <label>Voucher sử dụng</label> :
                                        Không sử dụng voucher nào 
                                    </p>
                                </div>
                                @else
                                <div class="col-6 ip-form">
                                    <p><i class="fa-solid fa-tag"></i> <label>Voucher sử dụng</label> :
                                        {{$item_payment->voucher_name}}
                                    </p>
                                </div>
                                <div class="col-6 ip-form">
                                    <p><i class="fa-solid fa-tag"></i> <label>Mã voucher sử dụng</label> :
                                        {{$item_payment->voucher_code}}
                                    </p>
                                </div>
                                @endif
                            </div>
                            <div class="col-6 ip-form">
                                <p><i class="fa-solid fa-credit-card"></i> <label>Thể loại thanh toán</label> :
                                    {{ $item_payment->category_payment_name}}</p>
                            </div>
                            <div class="col-6 ip-form">
                                <p><i class="fa-solid fa-clock"></i> <label>Thời gian</label> :
                                    {{ $item_payment->created_at}}</p>
                            </div>
                            <div class="col-12 ip-form">
                                <p><i class="fa-sharp fa-solid fa-location-dot"></i> <label>Địa chỉ</label> :
                                    {{ $item_payment->hoadon_address}}</p>
                            </div>
                        </div>
                    @endforeach
                        <div class="col-12  list-item-deatil">
                           @foreach ($hoadon_detail_item as $item_payment_deatil)
                               <div class="item-payment">
                                <p> <label for="">Tên sản phẩm</label> :{{$item_payment_deatil->product_name}} </p>
                                <p><label for="">Mã sản phẩm</label> :{{$item_payment_deatil->product_code}} </p>
                                <p><label for="">Giá sản phẩm</label> :{{ number_format($item_payment_deatil->product_price, 0, '.', ',') }} VNĐ </p>
                                <p><label for="">Số lượng</label> :{{$item_payment_deatil->hoadondeatil_quantyti}} </p>
                                <p><label for="">Kích cỡ</label> :{{$item_payment_deatil->hoadon_size}} </p>
                                <p><label for="">Màu sắc</label> :{{$item_payment_deatil->hoadon_color}} </p>
                               
                               </div>
                           @endforeach
                        </div>

                </div>
            </div>
        </section>

    </section>
@endsection
