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
                @foreach ($update_theloai as $item_theloai)
                {{-- <form  action="{{ route('post_theloai_update', ['theloai_id' =>$item_theloai->theloai_id ]) }}"    method="POST" class="row" > --}}
                 <form action=" {{  route('post_theloai_update', ['theloai_id' => $item_theloai->theloai_id])  }}" method="post"   class="row" >

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
                    <img id="theloai-img-up" src="{{$item_theloai->theloai_link_img}}" class="img-upload" alt="">
                </div>
                <div class="col-8 row">
                    <div class="col-6">
                        <div class="col-12 ip-form">
                            <label for="">Danh mục</label>
                            <select name="category_code" id="category_code_up">
                                @foreach ($getcategory as $item_getcategory)
                                <option value="{{$item_getcategory->category_id}}">{{$item_getcategory->category_name}}</option>
                                @foreach ($list_category as $key=>$item_category)
                                @if($item_category->category_id !=$item_getcategory->category_id)
                                <option value="{{ $item_category->category_id }}">{{ $item_category->category_name }}</option>
                                 @endif
                                @endforeach
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ip-form">
                            <label for="">Phân loại</label>
                            <select name="phanloai_code" id="phanloai_code_up">
                                @foreach ($getphanloai as $item_getphanloai)
                                <option value="{{$item_getphanloai->phanloai_id}}">{{$item_getphanloai->phanloai_name}}</option>
                                @foreach ($list_phanloai as $key=>$item_phanloai)
                                @if($item_phanloai->phanloai_id !=$item_getphanloai->phanloai_id )
                                <option value="{{ $item_phanloai->phanloai_id}}">{{ $item_phanloai->phanloai_name }}</option>
                                @endif
                                 @endforeach
                                @endforeach
            
                                
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ip-form">
                            <label for="">Tên thể loại</label>
                            <input type="text" name="theloai_name" id="theloai_name_up" value="{{$item_theloai->theloai_name}}" value="{{ old('theloai_name') }}" >
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
                            <input type="file" id="file-upload-up" class="bder-none file-upload" >
                         </div>
                        <div class="col-12 err"><span>
                            @error('category_code')
                            {{ $message }}
                                @enderror 
                                @if(session('errorMessage'))
                       
                                {{ session('errorMessage') }}
                           
                            @endif
                            </span></div>
                    </div>
                    <div class="col-12" style="display: none">
                        <h1 class="dis-none">{{$item_theloai->theloai_id}}</h1>
                    </div>
                    {{-- <div class="col-12 ip-form">
                        <button type="submit"  ><i class="fa-solid fa-pen"></i> Cập nhật thể loại</button>
                    </div> --}}
                    <div class="col-12 ip-form">
                        <button  id="post_img" onclick="uploadImage_theloai(event)"  type="submit" name="add-category"><i class="fa-solid fa-pen"></i> Cập nhật thể loại</button>
                        
                         
                    </div>
                </div>
                </form>
                @endforeach
              </div>
            </div>
</section>

</section>
@endsection
