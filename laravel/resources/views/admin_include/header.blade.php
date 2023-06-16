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
                    <span>Quản lý  sản phẩm</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('category_list') }}">Quản lý danh mục</a></li>
                    <li><a href="{{ route('phanloai_list') }}">Quản lý phân loại</a></li>
                    <li><a href="{{ route('theloai_list') }}">Quản lý thể loại</a></li>
                    <li><a href="{{ route('brand_list') }}">Quản lý Thương hiệu</a></li>
                    <li><a href="{{ route('size_list') }}">Quản lý kích cỡ(size)</a></li>
                    <li><a href="{{ route('status_list') }}">Quản lý trang thái</a></li>
                    <li><a href="{{ route('color_list') }}">Quản lý màu sắc</a></li>
                    <li><a href="{{ route('product_list') }}">Quản lý sản phẩm</a></li>
                   
                </ul>
            </li>
            <li>
                <a href="fontawesome.html">
                    <i class="fa-solid fa-users"></i>
                    <span>Quản lý người dùng</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa-solid fa-user"></i>
                    <span>Quản lý nhân viên</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('position_list') }}">Quản lý chức vụ</a></li>
                    <li><a href="flot_chart.html"><i class="fa fa-user"></i>Quản lý nhân viên</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Thống kê doanh thu</span>
                </a>
              
            </li>
            <li class="sub-menu">
                <a href="{{ route('banner_list') }}">
                    <i class="fa-sharp fa-regular fa-image"></i>
                    <span>Quản lý banner</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa-sharp fa-solid fa-ticket-simple"></i>
                    <span>Quản lý vocher</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Quản lý khác</span>
                </a>
                <ul class="sub">
                    <li><a href="typography.html">Liên hệ</a></li>
                    <li><a href="glyphicon.html">Quản lý góp ý</a></li>
                </ul>
            </li>
        </ul>            </div>
    <!-- sidebar menu end-->
</div>