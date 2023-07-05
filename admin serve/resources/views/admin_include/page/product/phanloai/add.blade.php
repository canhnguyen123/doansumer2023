@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới phân loại
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_phanloai_add') }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Tên phân loại</label>
                    <input type="text" name="phanloai_name" value="{{ old('phanloai_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('phanloai_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Mã phân loại</label>
                    <input type="text" name="phanloai_code"  value="{{ old('phanloai_code') }}" required>
                </div>
              
                <div class="col-12 err"><span>
                    @error('phanloai_code')
                    {{ $message }}
                        @enderror 
                        @if(session('errorMessage'))
               
                        {{ session('errorMessage') }}
                   
                        @endif
                    </span></div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-phanloai"><i class="fa-sharp fa-solid fa-plus"></i> Thêm phân loại</button>
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