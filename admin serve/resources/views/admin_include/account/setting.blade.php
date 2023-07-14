@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class="form-fiter row">
                <div class="table-agile-info">
                    <div class="panel panel-default row">
                        <div class="panel-heading heading">
                            <h4>Thông tin tài khoản </h4>
                        </div>
                        @foreach ($in4user as $item)
                        <div class="col-12 row">
                          <div class="col-4">
                            <img src="{{asset('upload/BE/'.$item->staff_linkimg)}}" class="img-upload" alt="">
                           </div>

                          <div class="col-8 row">
                          
                            <div class="col-6 ip-form pd-10">
                              <p><i class="fa-brands fa-codepen"></i> <label for="">Mã code  </label>: {{$item->staff_code}}</p>
                            </div>
                            <div class="col-6 ip-form pd-10">
                              <p><i class="fa-solid fa-user"></i><label for="">Tên đăng nhập </label>: {{$item->staff_username}}</p>
                            </div>
                            <div class="col-6 ip-form pd-10">
                              <p><i class="fa-solid fa-signature"></i><label for="">Họ tên </label>: {{$item->staff_fullname}}</p>
                            </div>
                            <div class="col-6 ip-form pd-10">
                              <p><i class="fa-solid fa-phone"></i><label for="">Số điện thoại </label>: {{$item->staff_phone}}</p>
                            </div>
                            <div class="col-6 ip-form pd-10">
                              <p><i class="fa-solid fa-envelope"></i><label for="">Email</label>: {{$item->staff_email}}</p>
                            </div>
                            <div class="col-6 ip-form pd-10">
                               <p><i class="fa-solid fa-clipboard-user"></i><label for="">Vị trí </label>: {{$item->chucvu_name}}</p>
                            </div>
                            <div class="col-12 ip-form pd-10">
                              <p><i class="fa-sharp fa-solid fa-location-dot"></i><label for="">Địa chỉ</label>: {{$item->staff_address}}</p>
                            </div>
                            <div class="col-12 ip-form pd-10">
                               <p><i class="fa-solid fa-notebook"></i><label for="">Ghi chú </label>: {{$item->staff_note}}</p>
                            </div>
                        
                          </div>
                        </div>
                        @endforeach
                            
                    </div>
                </div>
        </section>
    </section>
@endsection
