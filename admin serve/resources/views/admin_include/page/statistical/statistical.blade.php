@extends('admin')
@section('admin_content')
<section id="main-content">
	<section class="wrapper row">
    <div class="panel panel-default row">
  
      <div class="content col-12 row">
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
        <div class="col-12 agin_center response-money">
          <span id="response-money-data"></span>
        </div>
        <div class="col-12 titel-header">
          <h4>Doanh thu tháng gần đây</h4>
        </div>
        <div class="col-12">
          <canvas id="myChart"></canvas>
        </div>
        <div class="col-12 titel-header">
          <h4>Tỉ lệ người đăng kí các loại tài khoản</h4>
        </div>
        <div class="col-12">
          <canvas id="myChartCircle"></canvas>
        </div>
      </div>
    </div>
</section>

</section>
@endsection
