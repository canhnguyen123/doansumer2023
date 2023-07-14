@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Chi tiết nhân viên
                    </div>
                    @foreach ($staff_deatil as $item_deatil)
                        <div class="content col-12 row ">

                            <div class="col-4">
                                <img src="{{asset('upload/BE/'.$item_deatil->staff_linkimg)}}" class="img-upload" alt="">
                            </div>


                            <div class="col-8 row">
                                <div class="col-6 row">
                                    <div class="col-12 ip-form">
                                        <p> <label>Vị trí</label> : {{$item_deatil->chucvu_name}}</p>

                                    </div>

                                </div>
                           
                                <div class="col-6 row">
                                    <div class="col-12  ip-form ">
                                        <p><label>Mã nhân viên</label> :{{$item_deatil->staff_code}} </p> 
                                    </div>
                                </div>

                                <div class="col-6 row">
                                    <div class="col-12  ip-form ">
                                         <p> <label>Tên đăng nhập</label> :{{$item_deatil->staff_username}}</p>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <div class="col-12 ip-form ">
                                       <p><label>Họ tên</label>: {{$item_deatil->staff_fullname}}</p>
                                     
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <div class="col-12 ip-form">
                                        <p> <label>Số điện thoại</label> :  {{$item_deatil->staff_phone}}</p>
                                       
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <div class="col-12 ip-form">
                                        <p> <label>Email</label> : {{$item_deatil->staff_email}}</p>
                                       
                                    </div>
                                   
                                    
                                </div>
                                <div class="col-12  row">
                                    <div class="col-12 ip-form">
                                        <p><label>Địa chỉ cụ thể</label> : {{$item_deatil->staff_address}}</p>
                                        
                                    </div>
                                </div>
                                <div class="col-12  row">
                                    <div class="col-12 ip-form">
                                        <p><label>Trạng thái</label> : 
                                        @if ($item_deatil->staff_status==1)
                                            Hoạt động bình thường
                                        @elseif ($item_deatil->staff_status==0)
                                            Đang bị khóa
                                        @endif    
                                        </p>
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12 ip-form">
                                       
                                        <p> <label for="">Mô tả</label> : {{$item_deatil->staff_note}} </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </section>

    </section>
@endsection
