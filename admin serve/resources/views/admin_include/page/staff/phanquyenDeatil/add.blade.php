@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm chi tiết quyền
    </div>
    <div class="content col-12 ">
        <form action="{{ route('post_phanquyenDeatil_add')}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên nhóm quyền</label>
                  <select name="phanquyen_id" id="">
                    @foreach ($list_phanquyen as $item)
                        <option value="{{$item->phanquyen_id}}">{{$item->phanquyen_nameGroup}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên quyền chi tiết</label>
                    <input type="text" name="phanquyenDeatil_name" value="{{ old('phanquyenDeatil_name') }}" required>
                </div>
                <div class="col-12 err"><span>
                    @error('phanquyenDeatil_name')
                        {{ $message }}
                    @enderror    
            </span></div>
            </div>
            <div class="col-4">
                <div class="col-12 ip-form">
                    <label for="">Tên đường dẫn</label>
                    <input type="text" name="phanquyenDeatil_route" value="{{ old('phanquyenDeatil_route') }}" required>
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
                    <textarea name="phanquyenDeatil_mota" class="editor" cols="30" rows="10" required></textarea>
                </div>
                <div class="col-12 err"><span>
                    @error('phanquyenDeatil_mota')
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