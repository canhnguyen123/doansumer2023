@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
        
		<div class="table-agile-info">
 <div class="panel panel-default row">
    <div class="panel-heading heading">
    Tin nhắn với khách hàng
    </div>
    <div class="content col-12 chat-box-content row">
        <div  class="nav-collapse nav-bar-chat-box col-4">
            <!-- sidebar menu start-->
            <div class="leftside-navigation ">
                <ul class="sidebar-menu pd-top-0" >
                    @foreach ($list_user as $item_user)
                    <div class="item-user" style="display: flex" data-id="{{$item_user->user_id}}">

                        <div class="item-user-img">
                        <img src="{{ $item_user->user_img ? $item_cmt->user_img : 'https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/c6e56503cfdd87da299f72dc416023d4.jpg?alt=media&token=0f06f1ca-d5a1-48e8-a8e7-704fdca9f927' }}" alt="">

                        </div>
                        <div class="item-user-intro flex_start">
                             <p >{{$item_user->user_fullname}}</p> 

                        </div>
                    </div>
                    @endforeach
                    
                   
                  </ul>
               </div>
            <!-- sidebar menu end-->
        </div>
        <div class="col-8 content-chat pd-20-l-r">
            <div class="chat-content-header flex_start" data-id="">
                <div class="item-user-img-chat">
                    <img src="https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/c6e56503cfdd87da299f72dc416023d4.jpg?alt=media&token=0f06f1ca-d5a1-48e8-a8e7-704fdca9f927" alt="">

                </div>
                <div class="item-user-intro-chat flex_start">
                   <h3 id="select-useId-chat"></h3>
                </div>
            </div>
            <div class="chat-content-main">
                <div class="list-chat-mess">
                    {{-- <div class="item-chat-mess-left">
                        <p>hé lô bà già giữa màu đông cô đơn</p>
                    </div>
                    <div class="item-chat-mess-right">
                        <p>hé lô bà già giữa màu đông cô đơn</p>
                    </div> --}}
                </div>
                <div class="form-post-add-mess flex_center">
                    <form action="">
                        <input type="text" id="chat-text" placeholder="Nhập tin nhắn">
                        <button id="btn-post-chat"><i class="fa-solid fa-angle-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
  </div>
</div>
</section>

</section>
@endsection
