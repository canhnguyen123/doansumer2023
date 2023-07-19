@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">

            <div class="table-agile-info">
                <div class="panel panel-default row">
                    <div class="panel-heading heading">
                        Chức vụ chi tiết
                    </div>
                    @foreach ($list_chucvu as $item_chucvu)
                        <div class="content col-12 ">


                            <div class="col-12">
                                <div class="col-12 ip-form">
                                  <p class="text-ip"> <label for="">Tên chức vụ</label> : {{$item_chucvu->chucvu_name}}</p> 

                                </div>
                            </div>
                            <div class="col-12 ip-form">
                                <label for="">Nhóm các quyền được sử dụng : </label>
                            </div>
                            <div class="col-12">
                                @foreach ($groupquyen_prosition as $item)
                                    <div class="block mg-10">
                                       {{ $item->phanquyen_nameGroup }}
                                    </div>
                                @endforeach

                            </div>


                        </div>
                    @endforeach

                </div>
            </div>
        </section>

    </section>
@endsection
@if (session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location = "{{ route('payment.index') }}";
    </script>
@endif
