@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới trạng thái
    </div>
    <div class="content col-12 ">
        <form action="{{ route('status_post_add')}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Tên trạng thái</label>
                    <input type="text" name="status_name" value="{{ old('status_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('status_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Mã trạng thái</label>
                    <input type="text" name="status_code"  value="{{ old('status_code') }}" required>
                </div>
              
                <div class="col-12 err"><span>
                    @error('status_code')
                    {{ $message }}
                        @enderror 
                        @if(session('errorMessage'))
               
                        {{ session('errorMessage') }}
                   
                    @endif
                    </span></div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-status"><i class="fa-sharp fa-solid fa-plus"></i> Thêm trạng thái</button>
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