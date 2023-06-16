@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập  nhật màu sắc
    </div>
    <div class="content col-12 ">
        @foreach ($update_color as $key=>$item_color_up )
        <form action="{{ route('post_color_update', ['color_id' => $item_color_up->color_id ])  }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
            <div class="alert alert-danger text-center">
             <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
            </div>
        @endif
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Tên màu sắc</label>
                <input type="text" name="color_name" value="{{ $item_color_up->color_name }}" required>
            </div>
            <div class="col-12 err"><span>
                @error('color_name')
                    {{ $message }}
                @enderror    
            @if(session('errorMessage'))
           
                {{ session('errorMessage') }}
           
            @endif
        </span></div>
        </div>
            
            <div class="col-4 ip-form">
                <label for="">Mã màu sắc</label>
                <input type="text" name="color_code" value="{{ $item_color_up->color_code }}">
            </div>
            <div class="col-2 ip-form">
                <label for="">Trạng thái</label>
                @if ($item_color_up->color_status==1)
                <input type="checkbox" name="color_status" class="switch-toogel">
                @else
                <input type="checkbox" name="color_status" class="switch-toogel-red">
                @endif
               
            </div>
            <div class="col-12 ip-form">
                <button type="submit" name="update-color"><i class="fa-solid fa-pen"></i> Cập nhật phân loại</button>
            </div>
        </form>
        @endforeach
       
    </div>
  </div>
</div>
</section>

</section>
@endsection
@if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session("success") }}');
        };
    </script>
@endif