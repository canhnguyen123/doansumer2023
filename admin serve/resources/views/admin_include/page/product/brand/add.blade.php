@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới thương hiệu
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_brand_add')}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Tên thương hiệu</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('brand_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-6">
                <div class="col-12 ip-form">
                    <label for="">Mã thương hiệu</label>
                    <input type="text" name="brand_code"  value="{{ old('brand_code') }}" required>
                </div>
              
                <div class="col-12 err"><span>
                    @error('brand_code')
                    {{ $message }}
                        @enderror 
                        @if(session('errorMessage'))
               
                        {{ session('errorMessage') }}
                   
                    @endif
                    </span></div>
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-brand"><i class="fa-sharp fa-solid fa-plus"></i> Thêm thương hiệu</button>
            </div>
        </form>
    </div>
  </div>
</div>
</section>

</section>
@endsection
