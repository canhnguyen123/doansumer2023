@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">

                    <div class="panel-heading heading">
                        Chi tiết người dùng
                    </div>

                    <div class="content col-12 ">
                        @foreach ($deatil_user as $item_user)
                            <div class="col-12 row">
                                <div class="col-4">
                                    <img src="{{ $item_user->user_img }}" class="img-upload" alt="">
                                </div>
                                <div class="col-8 row">
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Họ tên</label> : <p>{{ $item_user->user_fullname }}</p>
                                    </div>
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Số điện thoại</label> : <p>{{ $item_user->user_phone }}</p>
                                    </div>
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Email</label> : <p>{{ $item_user->user_email }}</p>
                                    </div>
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Giới tính</label> :
                                        <p>
                                            @if ($item_user->user_gender == 0)
                                                Nữ
                                            @elseif ($item_user->user_gender == 1)
                                                Nam
                                            @elseif ($item_user->user_gender == 2)
                                                Chưa cập nhật
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Địa chỉ</label> :<p>{{ $item_user->user_address }}</p>
                                    </div>

                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Số xu trong tài khoản APP</label> : <p>
                                            {{ number_format($item_user->user_monney) }}</p>
                                    </div>
                                    <div class="col-12 user-item-col flex_nganng">
                                        <label for="">Trạng thái tài khoản</label> :
                                        <p>
                                            @if ($item_user->user_status == 0)
                                                Đang bị khóa
                                            @elseif ($item_user->user_status == 1)
                                                Hoạt động bình thường
                                            @endif
                                        </p>
                                    </div>
                                </div>
                        @endforeach
                    </div>

                    <div class="heading-titel pd-20 flex_center">
                         <h1>Chi tiết người dùng</h1> 
                     </div>
                     <div class="content col-12 ">
                        <form action="{{ route('update_money',['user_id'=>$user_id])}}" method="post" class="row ">
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-danger text-center">
                                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="col-12 ip-form">
                                    <label for="">Số tiền</label>
                                    <input type="text" name="user_money" value="{{ old('user_money') }}" required>
                                </div>
                                <div class="col-12 err"><span>
                                    @error('position_name')
                                        {{ $message }}
                                    @enderror    
                                @if(session('errorMessage'))
                               
                                    {{ session('errorMessage') }}
                               
                                @endif
                            </span></div>
                            </div>
 
                            <div class="col-12 ip-form">
                                <button type="submit" name="add-position" onclick="confirm('Bạn có muốn nạp tiền cho tài khoản này không')">Xác nhận nạp</button>
                            </div>
                        </form>
                    </div>
                    <div class="heading-titel pd-20 flex_center">
                        <h1>Lịch sử mua hàng</h1> 
                    </div>
                    <div class="content col-12 history-User">
                        @php
                            $i=1;
                        @endphp
                        @foreach ($historyBill as $ittemHistoryBill)
                        <a href="{{ route('payment_deatil',['hoadon_id'=>$ittemHistoryBill->hoadon_id]) }}">
                            <div class="item-history-user">
                                <div class="pd-10">
                                    <p><label for="">Đơn thứ :</label> {{$i++}}</p>
                                </div>
                                <div class="pd-10">
                                    <p><label for="">Mã đơn</label> : {{$ittemHistoryBill->hoadon_code}}</p>
                                </div>
                                <div class="pd-10">
                                    <p><label for="">Tổng tiền</label> :{{ number_format($ittemHistoryBill->hoadon_allprice, 0, ',', '.') }} VNĐ </p>
                                </div>
                                <div class="pd-10">
                                    <p><label for="">Thời gian</label> : {{$ittemHistoryBill->formatted_created_at}} </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </section>

    </section>
@endsection
