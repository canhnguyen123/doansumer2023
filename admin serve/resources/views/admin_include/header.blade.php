<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a class="active" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <hr>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>  Sản phẩm</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('category_list') }}"> Danh mục</a></li>
                    <li><a href="{{ route('phanloai_list') }}"> Phân loại</a></li>
                    <li><a href="{{ route('theloai_list') }}"> Thể loại</a></li>
                    <li><a href="{{ route('brand_list') }}"> Thương hiệu</a></li>
                    <li><a href="{{ route('size_list') }}"> Kích cỡ(size)</a></li>
                    <li><a href="{{ route('status_list') }}"> Trang thái</a></li>
                    <li><a href="{{ route('color_list') }}"> Màu sắc</a></li>
                    <li><a href="{{ route('product_list') }}"> Sản phẩm</a></li>
                   
                </ul>
            </li>
            <li>
                <a href="{{ route('user_list') }}" >
                    <i class="fa-solid fa-users"></i>
                    <span> Người dùng</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa-solid fa-user"></i>
                    <span> Hệ thống</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('position_list') }}"> chức vụ</a></li>
                    <li><a href="{{route('staff_list')}}"><i class="fa fa-user"></i> nhân viên</a></li>
                    <li><a href="{{ route('position_list') }}"> Phân quyền</a></li>
                    
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Hóa đơn</span>
                </a>
                <ul class="sub">
                    <li><a href="{{route('payment_list')}}">Hóa đơn</a></li>
                    <li><a href="{{route('status_payment_list')}}">Trạng thái hóa đơn</a></li>
                    <li><a href="{{route('category_payment_list')}}">Thể loại thanh toán</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{route('statistical')}}">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Thống kê</span>
                </a>
              
            </li>
            <li class="sub-menu">
                <a href="{{ route('banner_list') }}">
                    <i class="fa-sharp fa-regular fa-image"></i>
                    <span> banner</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="{{ route('voucher_list') }}">
                    <i class="fa-sharp fa-solid fa-ticket-simple"></i>
                    <span> vocher</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span> khác</span>
                </a>
                <ul class="sub">
                    <li><a href="typography.html">Liên hệ</a></li>
                    <li><a href="glyphicon.html"> góp ý</a></li>
                </ul>
            </li>
        </ul>            </div>
    <!-- sidebar menu end-->
</div>