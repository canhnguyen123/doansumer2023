@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập nhật chi tiết quyền
    </div>
    <div class="content col-12 ">
        @foreach ($update_phanquyenDeatil as $itemDeatl)
        <form action="{{ route('post_phanquyenDeatil_update',['phanquyenDeatil_id'=>$itemDeatl->phanquyenDeatil_Id])}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên nhóm quyền</label>
                  <select name="phanquyen_id" id="">
                    <option value="{{$itemDeatl->phanquyen_id}}">{{$itemDeatl->phanquyen_nameGroup}}</option>
                    @foreach ($list_phanquyen as $item)
                    @if ($itemDeatl->phanquyen_id!=$item->phanquyen_id)
                    <option value="{{$item->phanquyen_id}}">{{$item->phanquyen_nameGroup}}</option>
                    @endif
                       
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên quyền chi tiết</label>
                    <input type="text" name="phanquyenDeatil_name" value="{{$itemDeatl->phanquyenDeatil_name}}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('phanquyenDeatil_name')
                        {{ $message }}
                    @enderror    
                    @if(session('errorMessage'))
               
                    {{ session('errorMessage') }}
               
                @endif
            </span></div>
            </div>
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên đường dẫn</label>
                    <input type="text" name="phanquyenDeatil_route" value="{{$itemDeatl->phanquyenDeatil_route}}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('phanquyenDeatil_route')
                        {{ $message }}
                    @enderror    
            </span></div>
            </div>
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Mô tả</label>
                    <textarea name="phanquyenDeatil_mota" class="editor" cols="30" rows="10" required>
                        {{$itemDeatl->phanquyenDeatil_note}}
                    </textarea>
                </div>
            </div>
            <div class="col-12 ip-form">
                <button type="submit" name="add-phanquyen"><i class="fa-sharp fa-solid fa-plus"></i> Cập nhật quyền</button>
            </div>
        </form>
        @endforeach
    
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