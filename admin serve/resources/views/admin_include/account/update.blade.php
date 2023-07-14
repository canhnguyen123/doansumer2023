@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Cập nhật mật khẩu
                    </div>
                    <div class="content col-12 ">
                        <form action="{{ route('updatePassword',['id'=>Session::get('id')]) }}" method="post" class="row flex_center ">
                            @csrf
                            <div class="col-12 ip-form input-pass-form">
                                @if ($errors->any() || session('errorMessage'))
                                    <div class="alert alert-danger">
                                        @if ($errors->any())
                                            Có lỗi xảy ra. Vui lòng kiểm tra lại.
                                        @endif
                                        @if (session('errorMessage'))
                                            {{ session('errorMessage') }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 input-pass-form">

                                <div class="col-12 ip-form ">
                                    <label>Nhập mật khẩu cũ</label>
                                    <input type="password" name="oldPass" required>
                                </div>
                                <div class="col-12 err "><span class="mg-0">
                                        @error('oldPass')
                                            {{ $message }}
                                        @enderror
                                       
                                    </span></div>
                            </div>
                            <div class="col-12 input-pass-form">
                                <div class="col-12 ip-form ">
                                    <label>Nhập mật khẩu mới</label>
                                    <input type="password" name="newPass" required>
                                </div>
                                <div class="col-12 err"><span>
                                        @error('newPass')
                                            {{ $message }}
                                        @enderror
                                        @if (session('errorMessage'))
                                            {{ session('errorMessage') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
               
                            <div class="col-12 input-pass-form">
                                <div class="col-12 ip-form ">
                                    <label>Xác nhận mật khẩu mới</label>
                                    <input type="password" name="anewPass" required>
                                </div>
                                <div class="col-12 err"><span>
                                        @error('anewPass')
                                            {{ $message }}
                                        @enderror
                                       
                                    </span></div>
                            </div>
             

                            <div class="col-12 ip-form input-pass-form">
                                <button>Cập nhật mật khẩu</button>
                            </div>


                         </form>
            </div>

            </div>
            </div>
        </section>

    </section>
@endsection
