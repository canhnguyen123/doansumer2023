@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới voucher
    </div>
    <div class="content col-12 ">

    </div>
    <form  action="{{route('post_voucher_add')}}" method="POST" class="row" >
        {{ csrf_field() }}
        @if(session('errorMessage'))
            <div class="col-12 alert alert-danger text-center">
                {{ session('errorMessage') }}
            </div>
        @endif
    <div class="col-12 row">
      
        
        <div class="col-12">
         <div class="col-12 row">
            <div class="col-6 ip-form">
                <label for="">Tên voucher</label>
                <input type="text" name="voucher_name"  required>
            </div>
            <div class="col-3 ip-form">
                <label for="">Mã voucher</label>
                <input type="text" name="voucher_code" required>
            </div>
            <div class="col-3 ip-form">
                <label for="">Số tiền giảm giá</label>
                <input type="text" name="voucher_down" required>
            </div>
            <div class="col-4 ip-form">
                <label for="">Thể  loại giảm giá</label>
                <select name="voucher_type" id="voucher_type">
                    <option value="0">Giảm theo phần trăm</option>
                    <option value="1">Giảm theo số tiền VNĐ</option>
                    <option value="2">FreeShip</option>
                    <option value="3">Không áp mã</option>
                </select>
            </div>
           
            <div class="col-3 ip-form">
                <label for="">Đơn vị</label>
                <input type="text" name="voucher_unit" id="voucher_unit" value="%" required readonly>
            </div>
            <div class="col-5 ip-form">
                <label for="">Thể loại thanh toán</label>
                <select name="voucher_category_payment" id="">
                    @foreach ($list_category_payment as $item)
                        <option value="{{$item->category_payment_id}}">{{$item->category_payment_name}}</option>
                     @endforeach
                  
                </select>
            </div>
            <div class="col-4 ip-form">
                <label for="">Ngày bắt đầu áp dụng</label>
                <input type="text" class="timepiker" name="voucher_startDate" required>
            </div>

            <div class="col-4 ip-form">
                <label for="">Ngày kết thúc</label>
                <input type="text"  class="timepiker"  name="voucher_endDate" required>
            </div>
            <div class="col-4 ip-form">
                <label for="">Số lượng voucher</label>
                <input type="text"  class=""  name="voucher_quantity" required>
            </div>
            <div class="col-12 ip-form">
                <label for="">Mô tả voucher</label>
                <textarea name="mota_voucher" class="editor" cols="30" rows="10"></textarea>
            </div>
          
        </div>
        <div class="col-12 ip-form">
            <button type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Thêm voucher</button>
        </div>
    </div>
   
    </form>
  </div>
</div>
</section>

</section>
@endsection
