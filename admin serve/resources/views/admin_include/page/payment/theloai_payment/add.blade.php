@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
     Thêm mới phương thức thanh toán
    </div>
    <div class="content col-12 ">

    </div>
    <form  class="row" action="{{route('post_category_payment_add')}}" method="POST">
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
                <label>Tên phương thưc</label>
                <input type="text" name="category_payment_name" value=""><br>
            </div>
            <div class="col-12 err"><span>
                @error('category_payment_name')
                    {{ $message }}
                    @enderror 
                  
                </span></div>
        </div>
        <div class="col-12">
            <div class="col-12 ip-form">
                <label for="">Mô tả ngắn</label>
                <textarea name="category_payment_mota" class="editor" cols="30" rows="10" required></textarea>
            </div>

        </div>
        <div class="col-12 ip-form">
            <button  type="submit"><i class="fa-sharp fa-solid fa-plus"></i> Thêm phương thức </button>
        </div>
    </div>
   
    </form>
  </div>
</div>
</section>

</section>
@endsection
