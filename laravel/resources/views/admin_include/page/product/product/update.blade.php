@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Cập nhật mới thể loại
    </div>
    <div class="content col-12 ">

    </div>
    <form   class="row" >
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
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Danh mục</label>
                <select name="category_code" id="category_code">
                    @foreach ($list_category as $key=>$item_category)
                    <option value="{{ $item_category->category_code }}">{{ $item_category->category_name }}</option>
                    @endforeach
                
                </select>
                
            </div>
        </div>
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Phân loại</label>
                <select name="phanloai_code" id="phanloai_code">
                    @foreach ($list_phanloai as $key=>$item_phanloai)
                <option value="{{ $item_phanloai->phanloai_code}}">{{ $item_phanloai->phanloai_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Tên thể loại</label>
                <input type="text" name="theloai_name" id="theloai_name" value="{{ old('theloai_name') }}" >
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
        <div class="col-6">
            <div class="col-12 ip-form">
                <label for="">Ảnh đại diện</label>
                <input id="photo"  type="file" id="file-upload" class="bder-none file-upload" value="" required> </div>
            <div class="col-12 err"><span>
                @error('category_code')
                {{ $message }}
                    @enderror 
                    @if(session('errorMessage'))
           
                    {{ session('errorMessage') }}
               
                @endif
                </span></div>
        </div>
        <div class="col-12 ip-form">
            <button  id="post_img" onclick="uploadImage(event)"  type="submit" name="add-category"><i class="fa-solid fa-pen"></i> Cập nhật thể loại</button>
        </div>
    </div>
   
    </form>
  </div>
</div>
</section>

</section>
@endsection
