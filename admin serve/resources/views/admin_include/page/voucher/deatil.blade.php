@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Chi tiết voucher
                    </div>
                    <div class="content col-12 ">

                    </div>
                    @foreach ($deatil_voucher as $item)
            
                        <div class="col-12 row">


                            <div class="col-12">
                                <div class="col-12 row">
                                    <div class="col-6 ip-form pd-10">
                                        <p> <label>Tên voucher</label> : {{$item->voucher_name}}</p>

                                    </div>
                                    <div class="col-6 ip-form pd-10">
                                        <p> <label>Mã voucher</label> : {{$item->voucher_code}}</p>

                                    </div>
                                    <div class="col-6 ip-form pd-10">
                                         <p> <label for="">Số tiền giảm giá</label> : {{$item->voucher_down}}</p>
                                    
                                    </div>
                                    <div class="col-6 ip-form pd-10">
                                        <p> <label for="">Thể loại giảm giá</label> :
                                            @if ($item->voucher_category==0)
                                            Giảm theo phần trăm
                                        @elseif($item->voucher_category==1)
                                            Giảm theo số tiền VNĐ
                                        @elseif($item->voucher_category==2)
                                            FreeShip
                                        @elseif($item->voucher_category==3)
                                            Không áp mã
                                        @endif
                                            
                                            </p>
                                  
                                        
                                    </div>

                                    <div class="col-6 ip-form pd-10">
                                         <p>  <label for="">Đơn vị</label> : {{$item->voucher_unit}}</p>
                        
                                    </div>
                                    <div class="col-6 ip-form pd-10">

                                        <p>  <label for="">Thể loại thanh toán</label> : {{$item->category_payment_name}}</p>
                
                                    </div>
                                    <div class="col-6 ip-form pd-10">
                                       
                                        <p><label for="">Ngày bắt đầu áp dụng</label> : {{$item->voucher_start}}</p>
                                    </div>

                                    <div class="col-6 ip-form pd-10">
                                       <p> <label for="">Ngày kết thúc</label>   : {{$item->voucher_end}}</p>                                  
                                    </div>
                                       <div class="col-4 ip-form pd-10">
                                                                          
                                        <p> <label for="">Số lượng voucher</label>   : {{$item->voucher_limit}}</p>
                                    </div>
                                    <div class="col-12 ip-form pd-10">
                                        <p><label for="">Mô tả voucher</label>  : {{$item->voucher_context}}</p> 
                                    </div>

                                </div>
    
                            </div>

             
                    @endforeach
                   
                </div>
            </div>
        </section>

    </section>
@endsection
