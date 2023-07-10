@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới danh mục
    </div>
    <div class="content col-12 ">
        <form action="{{ route('category_post_add') }}" method="post" class="row">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Tên danh mục</label>
                    <input type="text" name="category_name" value="{{ old('category_name') }}" required>
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
                    <input type="text" name="category_code"  value="{{ old('category_code') }}" required>
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
                <button type="submit" name="add-category">
                    <i class="fa-sharp fa-solid fa-plus"></i> Thêm danh mục
                </button>
            </div>
        </form>
        
    </div>
  </div>
</div>
</section>

</section>
@endsection
    