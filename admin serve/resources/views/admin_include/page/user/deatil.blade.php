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

    </div>
    @foreach ($deatil_user as $item_user)
    <div class="col-12 row">
        <div class="col-4">
            <img src="{{$item_user->user_img}}" class="img-upload" alt="">
        </div>
        <div class="col-8 row">
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Họ tên</label> : <p>{{$item_user->user_fullname}}</p>
          </div>
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Số điện thoại</label> : <p>{{$item_user->user_phone}}</p>
          </div>
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Email</label> : <p>{{$item_user->user_email}}</p>
          </div>
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Giới tính</label> :
            <p>
                @if ($item_user->user_gender==0)
                    Nữ
                @elseif ($item_user->user_gender==1)
                Nam 
                @elseif ($item_user->user_gender==2)
                Chưa cập nhật
                @endif
            </p>
          </div>
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Địa chỉ</label> :<p>{{$item_user->user_address}}</p>
          </div>

          <div class="col-12 user-item-col flex_nganng">
            <label for="">Số xu trong tài khoản APP</label> : <p>{{ number_format( $item_user->user_monney) }}</p>
          </div>
          <div class="col-12 user-item-col flex_nganng">
            <label for="">Trạng thái tài khoản</label> : 
            <p>
                @if ($item_user->user_status==0)
                Đang bị khóa
                @elseif ($item_user->user_status==1)
                Hoạt động bình thường
                @endif
            </p>
          </div>
        </div>
    @endforeach
   
           
    </div> 
 
    
  </div>
</div>
</section>

</section>
@endsection
