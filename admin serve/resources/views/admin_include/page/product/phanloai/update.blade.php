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
        @foreach ($update_phanloai as $key=>$item_phanloai_up )
        <form action="{{ route('post_phanloai_update', ['phanloai_id' => $item_phanloai_up->phanloai_id ]) }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
            <div class="alert alert-danger text-center">
             <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
            </div>
        @endif
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Tên danh mục</label>
                <input type="text" name="phanloai_name" value="{{ $item_phanloai_up->phanloai_name }}" required>
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
            
            <div class="col-6 ip-form">
                <label for="">Mã danh mục</label>
                <input type="text" name="category_code" disabled="disabled" value="{{ $item_phanloai_up->phanloai_code }}">
            </div>
           
            <div class="col-12 ip-form">
                <button type="submit" name="update-category"><i class="fa-solid fa-pen"></i> Cập nhật phân loại</button>
            </div>
        </form>
        @endforeach
       
    </div>
  </div>
</div>
</section>

</section>
@endsection
