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
    @foreach ($update_voucher as $item_voucher)
    <form  action="{{route('post_voucher_update',['voucher_id'=>$item_voucher->voucher_id ])}}" method="POST" class="row" >
        {{ csrf_field() }}
        @if(session('errorMessage'))
            <div class="col-12 alert alert-danger text-center">
                {{ session('errorMessage') }}
            </div>
        @endif
    <div class="col-12 row">
      
       
        <div class="col-12">
            <div class="col-12 row">
               <div class="col-8 ip-form">
                   <label for="">Tên voucher</label>
                   <input type="text" value="{{$item_voucher->voucher_name}}" name="voucher_name"  required>
               </div>
               <div class="col-4 ip-form">
                   <label for="">Mã voucher</label>
                   <input type="text" value="{{$item_voucher->voucher_code}}" name="voucher_code" required>
               </div>
               <div class="col-4 ip-form">
                   <label for="">% giảm giá</label>
                   <input type="text" value="{{$item_voucher->voucher_down}}" name="voucher_down" required>
               </div>
               <div class="col-4 ip-form">
                   <label for="">Ngày bắt đầu áp dụng</label>
                   <input type="text" value="{{$item_voucher->voucher_start}}" class="timepiker" name="voucher_startDate" required>
               </div>
   
               <div class="col-4 ip-form">
                   <label for="">Ngày kết thúc</label>
                   <input type="text"  class="timepiker" value="{{$item_voucher->voucher_end}}"  name="voucher_endDate" required>
               </div>
               <div class="col-12 ip-form">
                   <label for="">Mô tả voucher</label>
                   <textarea name="mota_voucher" class="editor" cols="30" rows="10">{{$item_voucher->voucher_context}}</textarea>
               </div>
             
           </div>
           <div class="col-12 ip-form">
               <button type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật voucher</button>
           </div>
       
       
    </div>
   
    </form>
    @endforeach
  </div>
</div>
</section>

</section>
@endsection
