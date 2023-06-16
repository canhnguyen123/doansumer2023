@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập  nhật trạng thái
    </div>
    <div class="content col-12 ">
        @foreach ($update_status as $key=>$item_status_up )
        <form action="{{  route('status_post_update', ['status_id' => $item_status_up->status_id])  }}" method="post" class="row ">
            {{ csrf_field() }}
            <div class="col-6 ip-form">
                <label for="">Tên trạng thái</label>
                <input type="text" name="status_name" value="{{ $item_status_up->status_name }}" required>
            </div>
            <div class="col-6 ip-form">
                <label for="">Mã trạng thái</label>
                <input type="text" name="status_code" disabled="disabled" value="{{ $item_status_up->status_code }}">
            </div>
            
            <div class="col-12 ip-form">
                <button type="submit" name="update-status"><i class="fa-solid fa-pen"></i> Cập nhật trạng thái</button>
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