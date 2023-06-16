@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới size
    </div>
    <div class="content col-12 ">
        <form action="{{route('post_size_add') }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Tên size</label>
                    <input type="text" class="uppercase" name="size_name" value="{{ old('size_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('size_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Mô tả size</label>
                    <textarea id="" cols="30" rows="10" class="editor" name="size_describl" value="{{ old('size_describl') }}" required></textarea>
                </div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit"    name="add-size"><i class="fa-sharp fa-solid fa-plus"></i> Thêm size</button>
                
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