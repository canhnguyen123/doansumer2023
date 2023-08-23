@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class=" row">
                <div class="col-12">
                    <h3 class="quantity-titel ">Quản lý hình ảnh của sản phẩm</h3>
                </div>
              
                <div class="col-4 slider-product">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

                        <div class="carousel-inner">
                            @foreach ($list_img as $index => $item_img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                                    data-bs-interval="10000">
                                    <img src="{{ $item_img->img_name }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color: white">Ảnh thứ {{ $index + 1 }} <i class="fa-solid fa-pen update-img" data-id="{{ $item_img->img_id}}"></i> </h5>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-8 row girl-2">
                    <div class="">
                        <input type="file" id="upload-img-product">
                    </div>
                    <div class="" style="display: none">
                        <input type="checkbox" id="toggle-check-box">
                    </div>
                    
                    <div class="col-12 pd-50">
                        <button id="add-img-product" data-id="{{$product_id}}"> Thêm ảnh</button>
                    </div>
             
                </div>
            </div>

        </section>

    </section>
@endsection
