@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới màu sắc
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_color_add') }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Tên màu sắc</label>
                    <input type="text" name="color_name" value="{{ old('color_name') }}" required>
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
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Mã màu sắc</label>
                    <input type="text" name="color_code"  value="{{ old('color_code') }}" required>
                </div>
              
                <div class="col-12 err"><span>
                    @error('color_code')
                    {{ $message }}
                        @enderror 
                        @if(session('errorMessage'))
               
                        {{ session('errorMessage') }}
                   
                        @endif
                    </span></div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-color"><i class="fa-sharp fa-solid fa-plus"></i> Thêm màu sắc</button>
            </div>
        </form>
    </div>
  </div>
</div>
</section>

</section>
@endsection
@if (session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location = "{{ route('payment.index') }}";
    </script>
@endif