@php
$i = 0;
@endphp
@foreach ($list_product as $key => $item_product)
@php
    $i++;
@endphp
<tr data-expanded="true">
    <td>{{ $i }}</td>
    <td>{{ $item_product->theloai_name }}</td>
    <td colspan="2">{{ $item_product->product_name }}</td>
    <td>{{ $item_product->product_price }}</td>
    <td style="text-align: center">
        <p class="reslut_categgory_icon" style="display: none">
            {{ $item_product->product_status }}</p>
        @if ($item_product->product_status == 1)
            <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
        @elseif($item_product->product_status == 0)
            <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
        @endif
    </td>
    <td>
        <div class="flex_center icons">
            <div class="icon bg-yellow flex_center">
                <a
                    href="{{ route('product_deatil', ['product_id' => $item_product->product_id]) }}"><i
                        class="fa-solid fa-eye"></i></a>
            </div>
            <div class=" bg-bule flex_center icon">
                <a
                    href="{{ route('product_update', ['product_id' => $item_product->product_id]) }}">
                    <i class="fa-solid fa-pen"></i></a>
            </div>
            <div class=" bg-red flex_center icon">
                @if ($item_product->product_status == 1)
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái tắt không?')"
                        href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 1]) }}"><i
                            class="fa-solid fa-toggle-on"></i></a>
                @else
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái bật không ?')"
                        href="{{ route('togggle_status_product', ['product_id' => $item_product->product_id, 'product_status' => 0]) }}"><i
                            class="fa-solid fa-toggle-off"></i></a>
                @endif
            </div>
        </div>
    </td>
</tr>
@endforeach