@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập  nhật danh mục
    </div>
    <div class="content col-12 ">
        @foreach ($update_category as $key=>$item_category_up )
        <form action="{{ route('category_post_update', ['category_id' =>$item_category_up->category_id]) }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6 ">
                <div class="col-12 ip-form">
                    <label for="">Tên danh mục</label>
                    <input type="text" name="category_name" value="{{ $item_category_up->category_name }}" required>
                </div>
                <div class="col-12 err">
                    <span>
                        @error('category_name')
                            {{ $message }}
                        @enderror
                        @if(session('errorMessage'))
                            {{ session('errorMessage') }}
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Mã danh mục</label>
                <input type="text"   disabled="disabled" value="{{ $item_category_up->category_code }}">
                </div>
                <div class="col-12 err">
                    <span>
                        @error('category_code')
                            {{ $message }}
                        @enderror 
                        @if(session('errorMessage'))
                            {{ session('errorMessage') }}
                        @endif
                    </span>
                </div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="update-category"><i class="fa-solid fa-pen"></i> Cập nhật danh mục</button>
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