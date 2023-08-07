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
                    <div class="item-user" style="display: flex">

                        <div class="item-user-img">
                        <img src="{{ $item_user->user_img ? $item_cmt->user_img : 'https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/c6e56503cfdd87da299f72dc416023d4.jpg?alt=media&token=0f06f1ca-d5a1-48e8-a8e7-704fdca9f927' }}" alt="">

                        </div>
                        <div class="item-user-intro flex_start">
                             <a href="">{{$item_user->user_fullname}}</a> 

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
                   <h3>Bùi Duy Chiến</h3>
                </div>
            </div>
            <div class="chat-content-main">
                <div class="list-chat-mess">

                </div>
                <div class="form-post-add-mess flex_center">
                    <form action="">
                        <input type="text" id="chat-t" placeholder="Nhập tin nhắn">
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
