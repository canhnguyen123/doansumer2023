@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập nhật nhân viên
    </div>
    <div class="content col-12 ">

    </div>
    @foreach ($staff_update as $item_update)
    <form  class="row" action="{{route('post_staff_update',['staff_id'=>$item_update->id])}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($errors->any())
            <div class="alert alert-danger text-center">
            <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
            </div>
        @endif
        <div class="col-4">
            <img src="{{asset('upload/BE/'.$item_update->staff_linkimg)}}" class="img-upload" alt="">
        </div>
    <div class="col-8 row">
        <div class="col-6 row">
            <div class="col-12 ip-form">
                <label>Vị trí</label>
                <select name="staff_postition" id="">
               <option value="{{$item_update->chucvu_id}}">{{$item_update->chucvu_name}}</option> 
                @foreach ($list_position as $itemposition )
                    @if ($item_update->chucvu_name!=$itemposition->chucvu_name)
                    <option value="{{$itemposition->chucvu_id}}">{{$itemposition->chucvu_name}}</option>
                    @endif
                @endforeach
            </select>
            </div>
         
        </div>
        <div class="col-6 row">
            <div class="col-12 ip-form input-select-none">
                <label>Ảnh đại diện</label>
                <input type="file" class="bder-none file-upload"  name="staff_img" ><br>
            </div>
        
        </div>
      <div class="col-6 row">
            <div class="col-12  ip-form input-lable">
                <div class="icon-form-input"><i class="fa-brands fa-codepen"></i></div>
                <input type="text" name="staff_code" value="{{$item_update->staff_code}}" required>
                <label>Mã nhân viên</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_code')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
      
        <div class="col-6 row">
            <div class="col-12  ip-form input-lable">
                <div class="icon-form-input"><i class="fa-solid fa-user"></i></div>
              
                <input type="text" name="staff_name" value="{{$item_update->staff_username}}" required>
                <label>Tên đăng nhập</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_name')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        <div class="col-6 row">
            <div class="col-12 ip-form input-lable">
                <div class="icon-form-input"><i class="fa-solid fa-signature"></i></div>
                <input type="text" name="staff_fullname" value="{{$item_update->staff_fullname}}" required>
                <label>Họ tên</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_fullname')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        
        <div class="col-6 row">
            <div class="col-12 ip-form input-lable">
                <div class="icon-form-input"><i class="fa-solid fa-phone"></i></div>
                <input type="text" name="staff_phone" value="{{$item_update->staff_phone}}" required>
                <label>Số điện thoại</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_phone')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        <div class="col-6 row">
            <div class="col-12 ip-form input-lable">
                <div class="icon-form-input"><i class="fa-solid fa-envelope"></i></div>
                <input type="email" name="staff_email" value="{{$item_update->staff_email}}" required>
                <label>Email</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_email')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
      <div class="col-6"></div>
        <div class="col-4 row">
            <div class="col-12 ip-form">
                <label> Tỉnh/thành phố</label>
                <select name="" id="province">
            </select>
            </div>
         
        </div>
        <div class="col-4 row">
            <div class="col-12 ip-form">
                <label>Quận/huyện</label>
                <select name="" id="district">
                    <option value="">Chọn quận/huyện</option>
            </select>
            </div>
         
        </div>
        <div class="col-4 row">
            <div class="col-12 ip-form">
                <label>Phường/xã</label>
                <select name="" id="ward">
                    <option value="">Chọn phường/xã</option>
            </select>
            </div>
         
        </div>
        <div class="col-12 mg-20 row">
            <div class="col-12 ip-form input-lable">
                <div class="icon-form-input"><i class="fa-sharp fa-solid fa-location-dot"></i></div>
                <input type="text" name="staff_address_deatil" value="">
                <label>Địa chỉ cụ thể</label>
            </div>
            <div class="col-12 err"><span>
                @error('staff_address_deatil')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        <div class="col-12">
            <input type="hidden" name="staff_address" id="result_local" value="" required>
           </div>
        <div class="col-12">
            <div class="col-12 ip-form">
                <label for="">Mô tả</label>
                <textarea name="status_mota" class="editor" cols="30" rows="10">{{$item_update->staff_note}}</textarea>
            </div>
            <div class="col-12 err"><span>
                @error('theloai_name')
                    {{ $message }}
                @enderror    
          
        </span></div>
        </div>
        <div class="item-container">
            <div class="col-12">
                @foreach ($list_deatil as $itemdeatil)
                <div class="block mg-10">
                    <input type="checkbox" name="listQuyenDeatil[]" value="{{$itemdeatil->phanquyenDeatil_Id}}" @if ($list_deatil_user->contains('phanquyenDeatil_Id', $itemdeatil->phanquyenDeatil_Id)) checked @endif>
                    {{$itemdeatil->phanquyenDeatil_name}}
                </div>
            @endforeach
            
            @foreach ($list_deatil_user as $itemdeatil_user)
                @php
                    $isChecked = $list_deatil->contains('phanquyenDeatil_Id', $itemdeatil_user->phanquyenDeatil_Id);
                @endphp
                @if (!$isChecked)
                    <div class="block mg-10">
                        <input type="checkbox" name="listQuyenDeatil[]" value="{{$itemdeatil_user->phanquyenDeatil_Id}}" checked>
                        {{$itemdeatil_user->phanquyenDeatil_name}}({{$itemdeatil_user->phanquyenDeatil_route}})
                    </div>
                @endif
            @endforeach
            </div>
            
        </div>
        <div class="col-12 ip-form">
            <button type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật nhân viên</button>
        </div>
    </div>
   
    </form>
    @endforeach
  
  </div>
</div>
</section>

</section>
@endsection
