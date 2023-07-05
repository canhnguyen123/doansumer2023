@foreach ($list_quantityNew as $item_quantity)
<div class="item-req">
    <i class="fa-solid fa-x close-item-product"></i>
    <div class="item-res-pro">
        <p>Color</p>: <p>{{$item_quantity->quantity_color}} </p>
    </div>
    <div class="item-res-pro">
        <p>size</p>: <p class="size-item-Pro">{{$item_quantity->quantity_size}}</p>
    </div>
    <div class="item-res-pro">
        <p>SL</p>: <p class="quantyti-item-Pro">{{$item_quantity->quantity_sl}}</p>
    </div>
    <div class="item-icon">
        <i class="fa-solid fa-pen"></i>
        <i onclick="delete_quantity({{$item_quantity->quantity_id }},{{$item_product->product_id}})" class="fa-sharp fa-solid fa-trash"></i>
    </div>
</div>
@endforeach