@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập nhật  nhóm quyền
    </div>
    <div class="content col-12 ">
        @foreach ($update_phanquyen as $item)
        <form action="{{ route('post_phanquyen_update',['phanquyen_id'=>$item->phanquyen_id])}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Tên nhóm quyền</label>
                    <input type="text" name="phanquyen_name" value="{{$item->phanquyen_nameGroup}}" required>
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
                    <textarea name="phanquyen_mota" class="editor" cols="30" rows="10" required>{{$item->phanquyen_note}}</textarea>
                </div>
            </div>
            <div class="col-12 ip-form">
                <button type="submit" name="add-phanquyen"><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật nhóm quyền</button>
            </div>
        </form>
        @endforeach
       
    </div>
  </div>
</div>
</section>

</section>
@endsection
