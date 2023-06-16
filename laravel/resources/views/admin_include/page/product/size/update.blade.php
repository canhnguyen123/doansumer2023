@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập  nhật size
    </div>
    <div class="content col-12 ">
        @foreach ($update_size as $key=>$item_size_up )
        <form action="{{ route('post_size_update', ['id_size' => $item_size_up->id_size ]) }}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
            <div class="alert alert-danger text-center">
             <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
            </div>
        @endif
        <div class="col-8">
            <div class="col-12 ip-form">
                <label for="">Tên size</label>
                <input type="text" class="uppercase" name="size_name" value="{{$item_size_up->name_size}}" value="{{ old('size_name') }}"  required>
            </div>
            <div class="col-12 err"><span>
                @error('name_size')
                    {{ $message }}
                @enderror    
            @if(session('errorMessage'))
           
                {{ session('errorMessage') }}
           
            @endif
        </span></div>
        </div>
            
           
            <div class="col-4 ip-form">
                <label for="">Trạng thái</label> <br>
                 {{-- {{ $item_size_up->status_size }} --}}
               
                @if ($item_size_up->status_size==1)
                <input type="checkbox" name="size_status" class="switch-toogel">
                @elseif ($item_size_up->status_size==0)
                <input type="checkbox" name="size_status" class="switch-toogel-red">
                @endif
               
            </div>
            <div class="col-12 ip-form">
                <label for="">Mã size</label>
                <textarea id="" cols="30" rows="10" class="editor" name="size_describl"  required> {{$item_size_up->describle_size}}</textarea>
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
@if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session("success") }}');
        };
    </script>
@endif