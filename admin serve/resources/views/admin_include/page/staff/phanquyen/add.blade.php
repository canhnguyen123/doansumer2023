@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới nhóm quyền
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_phanquyen_add')}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Tên nhóm quyền</label>
                    <input type="text" name="phanquyen_name" value="{{ old('phanquyen_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('phanquyen_name')
                        {{ $message }}
                    @enderror    
            </span></div>
            </div>
        
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Mô tả</label>
                    <textarea name="phanquyen_mota" class="editor" cols="30" rows="10" required></textarea>
                </div>
                <div class="col-12 err"><span>
                    @error('theloai_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-12 ip-form">
                <button type="submit" name="add-phanquyen"><i class="fa-sharp fa-solid fa-plus"></i> Thêm nhóm quyền</button>
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