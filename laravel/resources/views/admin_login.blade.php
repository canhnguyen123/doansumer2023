<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link href="{{ asset("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css") }}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css') }}" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('BE/css/login.css')}}">
</head>
<body>
  <div class="main-login">
    <div class="login row">
      <div class="col-6 left ">
        <div class="titel-form flex_center">
          <h1>Đăng nhập</h1><br>
      
        </div>
        <div class="row">
          <form action="{{ URL::to('/login-post') }}" method="POST" class="row">
			{{ csrf_field() }}
            <div class="input-form">
              <div class="icons flex_center"><i class="fa-solid fa-user"></i></div>
              <input type="text" name="username_nv" required>
              <label for="">Tên đăng nhập</label>
            </div>
            <div class="err"><span>
              <?php
              $mess=Session::get('mess');
              if($mess){
               echo $mess;
               Session::put("mess",null);
              }
              ?>
            </span> </div>
            <div class="input-form">
              <div class="icons flex_center"><i class="fa-solid fa-lock"></i></div>
              <input type="password" name="password_nv" id="password" required>
              <label for="">Mật khẩu</label>
              <i class="fa-solid fa-eye eye-open" id="open-eys"></i>
              <i class="fa-sharp fa-solid fa-eye-slash eye-close" id="close-eyes" style="display: none;"></i>
            </div>
            <div class="err"><span>
              <?php
              $mess=Session::get('mess');
              if($mess){
               echo $mess;
               Session::put("mess",null);
              }
              ?></span> </div>
            <div class="button-form">
              <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</button>
            </div>
          </form>
        </div>
   
      </div>
      <div class="col-6 right flex_center">
        <div class="banner-img ">
          <img src="{{ asset('BE/images/banner-login132.jpg') }}" alt="">
        </div>
        
      </div>
     
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
   $(document).ready(function() {
  $("#open-eys").click(function() {
    $("#password").attr("type", "text");
    $("#open-eys").toggle();
    $("#close-eyes").toggle();
  });

  $("#close-eyes").click(function() {
  $("#password").attr("type", "password");
    $("#close-eyes").toggle();
    $("#open-eys").toggle();
  });
});
  </script>
</body>
</html>