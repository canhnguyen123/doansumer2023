@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới banner
    </div>
    <div class="content col-12 ">

    </div>
    <form  class="row" >
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
    <div class="col-4">
        <img src="" class="img-upload" alt="">
    </div>
    <div class="col-8 row">
      
        
        <div class="col-12">
            <div class="col-12 ip-form">
                <label for="">Ảnh đại diện</label>
                <input  type="file" id="file-upload-banner" class="bder-none file-upload" value="" required> </div>
            <div class="col-12 err"><span>
                @error('category_code')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        <div class="col-12">
            <div class="col-12 ip-form">
                <label for="">Mô tả</label>
                <textarea name="mota_banner" id="mota_banner" class="editor" cols="30" rows="10"></textarea>
            </div>
            <div class="col-12 err"><span>
                @error('theloai_name')
                    {{ $message }}
                @enderror    
            @if(session('errorMessage'))
           
                {{ session('errorMessage') }}
           
            @endif
        </span></div>
        </div>
        <div class="col-12 ip-form">
            <button  id="post_img" onclick="uploadImage_banner(event)" name="add-category"><i class="fa-sharp fa-solid fa-plus"></i> Thêm thể loại</button>
        </div>
    </div>
   
    </form>
  </div>
</div>
</section>

</section>
@endsection
