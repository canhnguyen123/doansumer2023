@extends('admin')
@section('admin_content')
    <section id="main-content">
        <section class="wrapper row">
            <div class=" row">
                <div class="col-12">
                    <h3 class="quantity-titel ">Quản lý sản phẩm theo size</h3>
                </div>
                @foreach ($deatilProduct as $itemdeatilProduct)
                <form action="{{ route('post_quantity_add',['product_id'=>$itemdeatilProduct->product_id]) }}" method="post">
                    {{ csrf_field() }}
                    @if (session('errorMessage'))
                        <div class="col-12 alert alert-danger text-center">
                            <span>{{ session('errorMessage') }}</span>
                        </div>
                    @endif
                    <div class="col-12 row">
                        <div class="col-4">
                            <p><label for="">Mã sản phẩm  : </label> {{$itemdeatilProduct->product_code}}</p>
                        </div>
                        <div class="col-4">
                            <p><label for="">Tên sản phẩm  : </label> {{$itemdeatilProduct->product_name}}</p>
                        </div>
                        <div class="col-4">
                            <p><label for="">Giá sản phẩm  : </label> {{$itemdeatilProduct->product_price}}</p>
                        </div>
                      
                    </div>
                    <div class="col-12">
                        <label for="">Size</label>
                        <div class="flex_start">
                            @foreach ($list_size as $index => $item_size)
                                <div class="item_flex-mglr-5">
                                    <label class="ip-csr" for="">{{ $item_size->name_size }}</label>
                                    <input type="radio"  class="product-size-item" name="quantityProSize" id="product-size-item"
                                        value="{{ $item_size->name_size }}"
                                        @if ($index === 0) checked @endif><br>
                                </div>
                            @endforeach
                        </div>

                    </div>
                  
                    <div class="col-12">
                        <label for="">Color</label>
                        <div class="flex_start">
                            @foreach ($list_color as $index => $item_color)
                            <div class="item_flex-mglr-5">
                                <label class="ip-csr" for="">{{ $item_color->color_name }}</label>
                                <input type="radio" class="product-color-item" id="product-color-item" name="quantityProColor"
                                    value="{{ $item_color->color_name }}"
                                    @if ($index === 0) checked @endif><br>
                            </div>
                        @endforeach
                        
                        </div>

                    </div>


                    <div class="col-12 row mg-20">
                        <div class="col-12 ip-form input-lable-form">
                            <input type="text" id="quantityItem" name="quantityPros"  class="quantityPro input-quantity-ls" value="1" required>
                            <label for="">Nhập số lượng</label>
                        </div>

                    </div>
                    <div class="col-12 input-lable-form pd-0">
                        <button type="submit" id="btn-add-list-q">Thêm</button>
                        <button  id="btn-update-list-q" style="display: none" onclick="update_quantity( $item_size->quantity_id , $itemdeatilProduct->product_id)">Sửa</button>
                    </div>
                </form>


                <div class="col-12 res-them res-them-quantity  pd-0">
                    @foreach ($list_quantytyProduct as $item_quantity)
                    <div class="item-req p-l-20">
                        <div class="item-res-pro">
                            <p>Color</p>: <p class="color-quantity-d" id="item-res-color-Pro">{{ $item_quantity->quantity_color }}</p>
                        </div>
                        <div class="item-res-pro">
                            <p>size</p>: <p class="size-quantity-d" id="item-res-size-Pro" class="size-item-Pro">{{ $item_quantity->quantity_size }}</p>
                        </div>
                        <div class="item-res-pro">
                            <p>SL</p>: <p class="quantity-quantity-d" id="item-res-quantity-Pro" class="quantyti-item-Pro">{{ $item_quantity->quantity_sl }}</p>
                        </div>
                        <div class="item-res-pro">
                            <p>Trạng thái : </p>
                            <p id="item-res-quantity-Pro">
                                @if ($item_quantity->quantity_status == 1)
                                    đang bật
                                @else
                                    đang tắt
                                @endif
                            </p>
                        </div>
                        <div class="item-icon">
                            <i onclick="getDataQuantity(this)" class="fa-solid fa-pen icon-update-list-pro"></i>
                            <i onclick="close_update(this)" class="fa-sharp fa-solid fa-circle-xmark close-icon-pro" style="display: none"></i>
                            @if ($item_quantity->quantity_status == 1)
                                <a onclick="return confirm('Bạn có muốn chuyển sang trạng thái tắt không?')"
                                    href="{{ route('togggle_status_quantity', ['quantity_id' => $item_quantity->quantity_id, 'quantity_status' => 1,'product_id'=>$itemdeatilProduct->product_id]) }}">
                                    <i class="fa-solid fa-toggle-on"></i>
                                </a>
                            @else
                                <a onclick="return confirm('Bạn có muốn chuyển sang trạng thái bật không ?')"
                                    href="{{ route('togggle_status_quantity', ['quantity_id' => $item_quantity->quantity_id, 'quantity_status' => 0,'product_id'=>$itemdeatilProduct->product_id]) }}">
                                    <i class="fa-solid fa-toggle-off"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
                

                </div>
                @endforeach
              
            </div>

        </section>

    </section>
@endsection
