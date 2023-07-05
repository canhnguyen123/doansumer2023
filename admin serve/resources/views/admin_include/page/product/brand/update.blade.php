@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập  nhật thương hiệu
    </div>
    <div class="content col-12 ">
        @foreach ($update_brand as $key=>$item_brand_up )
        <form action="{{ route('post_brand_update', ['brand_id' =>$item_brand_up->brand_id]) }}" method="post" class="row ">
            {{ csrf_field() }}
            <div class="col-6 ip-form">
                <label for="">Tên thương hiệu</label>
                <input type="text" name="brand_name" value="{{ $item_brand_up->brand_name }}" required>
            </div>
            <div class="col-6 ip-form">
                <label for="">Mã thương hiệu</label>
                <input type="text" name="brand_code" disabled="disabled" value="{{ $item_brand_up->brand_code }}">
            </div>

            <div class="col-12 ip-form">
                <button type="submit" name="update-brand"><i class="fa-solid fa-pen"></i> Cập nhật thương hiệu</button>
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