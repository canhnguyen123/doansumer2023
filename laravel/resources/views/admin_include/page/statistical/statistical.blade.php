@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới chức vụ
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_position_add')}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Tên chức vụ</label>
                    <input type="text" name="position_name" value="{{ old('position_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('position_name')
                        {{ $message }}
                    @enderror    
                @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
        
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-position"><i class="fa-sharp fa-solid fa-plus"></i> Thêm chức vụ</button>
            </div>
        </form>
    </div>
  </div>
</div>
</section>

</section>
@endsection
