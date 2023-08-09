@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row flex_center">
    <div class="panel panel-default row w-95">
  
      <div class="content col-12 row">
        <div class="col-12 tabs flex_center">
          <div class="tab-item active">Doanh số</div>
          <div class="tab-item">Tỉ lệ hủy chốt đơn </div>
          <div class="tab-item">Tài khoản</div>
          <div class="line"></div>
      </div>
      <div class="col-12  tab-content">
        <div class="tab-pane row active">
          <div class="col-12 titel-header">
            <h4>Tra doanh số</h4>
          </div>
          <div class="col-12 row">
           
              <div class="col-4 ip-form agin_center">
                <label for="">Từ ngày</label>
                <input type="text" id="startDate" class="timepiker"  required>
               
              </div>
              <div class="col-4 ip-form agin_center">
                <label for="">Đến ngày</label>
                <input type="text" id="endDate" class="timepiker"  required>
               
              </div>
              <div class="col-4 ip-form agin_center">
                <button onclick="fiterDate(event)">Xem </button>
              </div>
            
          </div>
          <div class="col-12  response-money">
            <span id="response-money-data"></span><br>
            <span id="response-money-goc"></span><br>
            <span id="response-money-lai"></span><br>
            <span id="response-money-percent"></span><br>
          </div>
          <div class="col-12 titel-header">
            <h4>Kiểm tra doanh số</h4>
          </div>
          <div class="col-12 row">
           
              <div class="col-3 ip-form agin_center" >
               <select name=""id="data-time-payment">
                <option value="today">Hôm nay</option>
                <option value="yesterday">Hôm qua</option>
                <option value="this_week">Tuần này</option>
                <option value="last_week">Tuần trước</option>
                 <option value="this_month">Tháng này</option>
                 <option value="this_year">Năm nay</option>
                 <option value="last_year">Năm ngoái</option>
                 <option value="all">Tất cả</option>
               </select>
             </div>
             <div class="col-3 ip-form agin_center">
              <button id="select-data-payment">Xem </button>
            </div>
            <div class="col-6 req-start flex-start">
              <span id="set-data-bill"></span>
            </div>
          </div>
        
          <div class="col-12 titel-header">
            <h4>Doanh thu 6 tháng gần đây</h4>
          </div>
          <div class="col-12">
            <canvas id="myChartbill"></canvas>
          </div>
    </div>
    <div class="tab-pane">
      <div class="col-12 titel-header">
        <h4>Tỉ lệ chôt/hủy đơn 6 tháng gần đây</h4>
      </div>
      <div class="col-12">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="tab-pane">
      <div class="col-12 titel-header">
        <h4> Tra nhanh người dùng</h4>
      </div>
      <div class="col-12 row">
       
          <div class="col-3 ip-form agin_center row">
            <div class="col-12 ip-form">
              <label for="">Thời gian</label>
            </div>
            <div class="col-12 ip-form">
              <select name=""id="data-time-user-check">
                    <option value="today">Hôm nay</option>
                    <option value="yesterday">Hôm qua</option>
                    <option value="this_week">Tuần này</option>
                    <option value="last_week">Tuần trước</option>
                    <option value="this_month">Tháng này</option>
                    <option value="this_year">Năm nay</option>
                    <option value="last_year">Năm ngoái</option>
                    <option value="all">Tất cả</option>
               </select>
            </div>
         </div>
         <div class="col-3 ip-form agin_center row" >
          <div class="col-12 ip-form"><label for="">Trạng thái</label></div>
          <div class="col-12 ip-form">
            <select name=""id="data-time-user-status">
              <option value="all">Tất cả</option>
              <option value="1">Hoạt động bình thường</option>
              <option value="0">Bị khóa</option>
             </select>
          </div>
        </div>
        <div class="col-3 ip-form agin_center row">
          <div class="col-12 ip-form"><label for="">Thể loại tài khoản</label></div>
          <div class="col-12 ip-form">
            <select name=""id="data-time-user-category">
            <option value="all">Tất cả tài khoản</option>
            <option value="1">Thể loại tài khoản</option>
            <option value="2">Tài khoản facebook</option>
            <option value="3">Tài khoản googel</option>
           </select></div>
        </div>
         <div class="col-3 ip-form flex_end_a ">
          <button id="view-data-user-count" style="margin-bottom: 15px">Xem </button>
        </div>
        <div class="col-12 req-start flex-start">
          <span id="set-data-user-check"></span>
        </div>
      </div>
       <div class="col-12 titel-header">
        <h4>Tỉ lệ người đăng kí các loại tài khoản</h4>
      </div>
      
      <div class="col-12">
        <canvas id="myChartCircle"></canvas>
      </div>      
        </div>
    </div>
  </div>
</div>
</section>

</section>
@endsection
