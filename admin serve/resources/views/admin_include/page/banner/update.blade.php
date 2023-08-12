@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập nhật  banner
    </div>
    <div class="content col-12 ">
        @foreach ($update_banner as $item)
        <form  class="row" action="{{route('post_banner_update',['banner_id'=>$item->banner_id])}}" method="POST">
            {{ csrf_field() }}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            
                </div>
            @endif
                <div class="col-12 row">
             
            <div class="col-12">
                <div class="col-12 ip-form">
                    <label for="">Mô tả</label>
                    <textarea name="mota_banner" class="editor" cols="30" rows="10">{{$item->banner_note}}</textarea>
                </div>
             
          
            <div class="col-12 ip-form">
                <button ><i class="fa-solid fa-pen"></i> Cập nhật</button>
            </div>
        </div>
       
        </form>
        @endforeach
    </div>


  </div>
</div>
</section>

</section>
@endsection
