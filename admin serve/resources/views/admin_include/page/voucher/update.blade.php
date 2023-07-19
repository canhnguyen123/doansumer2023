@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Cập nhật voucher
                    </div>
                    <div class="content col-12 ">

                    </div>
                    @foreach ($update_voucher as $item_update)
                    <form action="{{ route('post_voucher_update',['voucher_id'=>$item_update->voucher_id]) }}" method="POST" class="row">
                        {{ csrf_field() }}
                        @if (session('errorMessage'))
                            <div class="col-12 alert alert-danger text-center">
                                {{ session('errorMessage') }}
                            </div>
                        @endif
                        <div class="col-12 row">


                            <div class="col-12">
                                <div class="col-12 row">
                                    <div class="col-6 ip-form">
                                        <label for="">Tên voucher</label>
                                        <input type="text" name="voucher_name" value="{{$item_update->voucher_name}}" required>
                                    </div>
                                    <div class="col-3 ip-form">
                                        <label for="">Mã voucher</label>
                                        <input type="text" name="voucher_code" value="{{$item_update->voucher_code}}" required>
                                    </div>
                                    <div class="col-3 ip-form">
                                        <label for="">Số tiền giảm giá</label>
                                        <input type="text" name="voucher_down" value="{{$item_update->voucher_down}}" required>
                                    </div>
                                    <div class="col-4 ip-form">
                                        <label for="">Thể loại giảm giá</label>
                                        <select name="voucher_type" id="voucher_type">
                                            <option value="{{$item_update->voucher_category}}">
                                                @if ($item_update->voucher_category==0)
                                                    Giảm theo phần trăm
                                                @elseif($item_update->voucher_category==1)
                                                    Giảm theo số tiền VNĐ
                                                @elseif($item_update->voucher_category==2)
                                                    FreeShip
                                                @elseif($item_update->voucher_category==3)
                                                    Không áp mã
                                                @endif
                                            </option>
                                            <option value="0" @if($item_update->voucher_category == 0) style="display: none;" @endif>Giảm theo phần trăm</option>
                                            <option value="1" @if($item_update->voucher_category == 1) style="display: none;" @endif>Giảm theo số tiền VNĐ</option>
                                            <option value="2" @if($item_update->voucher_category == 2) style="display: none;" @endif>FreeShip</option>
                                            <option value="3" @if($item_update->voucher_category == 3) style="display: none;" @endif>Không áp mã</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-3 ip-form">
                                        <label for="">Đơn vị</label>
                                        <input type="text" name="voucher_unit" id="voucher_unit" value="{{$item_update->voucher_unit}}" required
                                            readonly>
                                    </div>
                                    <div class="col-5 ip-form">
                                        <label for="">Thể loại thanh toán</label>
                                        <select name="voucher_category_payment" id="">
                                            <option value="{{$item_update->category_payment_id}}">{{$item_update->category_payment_name}}</option>
                                            @foreach ($list_category_payment as $item)
                                            @if ($item_update->category_payment_id!=$item->category_payment_id)
                                               
                                                <option value="{{ $item->category_payment_id }}">
                                                    {{ $item->category_payment_name }}</option>
                                                  
                                            @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-4 ip-form">
                                        <label for="">Ngày bắt đầu áp dụng</label>
                                        <input type="text" class="timepiker" name="voucher_startDate" value="{{$item_update->voucher_start}}" required>
                                    </div>

                                    <div class="col-4 ip-form">
                                        <label for="">Ngày kết thúc</label>
                                        <input type="text" class="timepiker" name="voucher_endDate" value="{{$item_update->voucher_end}}"  required>
                                    </div>
                                    <div class="col-4 ip-form">
                                        <label for="">Số lượng voucher</label>
                                        <input type="text" class="" name="voucher_quantity" value="{{$item_update->voucher_limit}}"  required>
                                    </div>
                                    <div class="col-12 ip-form">
                                        <label for="">Mô tả voucher</label>
                                        <textarea name="mota_voucher" class="editor" cols="30" rows="10">{{$item_update->voucher_context}}</textarea>
                                    </div>

                                </div>
                                <div class="col-12 ip-form">
                                    <button type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật</button>
                                </div>
                            </div>

                    </form>
                    @endforeach
                   
                </div>
            </div>
        </section>

    </section>
@endsection
