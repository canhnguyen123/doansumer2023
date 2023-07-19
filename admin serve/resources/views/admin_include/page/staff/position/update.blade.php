@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
    Cập nhật chức vụ
    </div>
    @foreach ($list_chucvu as $itemchucvu)
    <div class="content col-12 ">
        <form action="{{ route('post_position_update',['position_id'=>$itemchucvu->chucvu_id])}}" method="post" class="row ">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                 <span>Có lỗi xảy ra vui lòng kiểm tra lại dữ liệu</span>
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Tên chức vụ</label>
                    <input type="text" name="position_name" value="{{$itemchucvu->chucvu_name}}" required>
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
            <div class="col-12">
                @foreach ($groupquyen_prosition as $itemGroup)
                    <div class="block mg-10">
                        <input type="checkbox" name="listQuyen[]" value="{{$itemGroup->phanquyen_id}}" checked>{{$itemGroup->phanquyen_nameGroup}}
                    </div>
                @endforeach
                @foreach ($list_phanquyen as $item)
                    @php
                        $isChecked = true;
                    @endphp
                    @foreach ($groupquyen_prosition as $itemGroup)
                        @if ($itemGroup->phanquyen_id == $item->phanquyen_id)
                            @php
                                $isChecked = false;
                                break;
                            @endphp
                        @endif
                    @endforeach
                    @if ($isChecked)
                        <div class="block mg-10">
                            <input type="checkbox" name="listQuyen[]" value="{{$item->phanquyen_id}}">{{$item->phanquyen_nameGroup}}
                        </div>
                    @endif
                @endforeach
            </div>
            
            
           
            <div class="col-12 ip-form">
                <button type="submit" name="add-position"><i class="fa-solid fa-pen"></i> Cập  nhật chức vụ</button>
            </div>
        </form>
    </div>
    @endforeach
    
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