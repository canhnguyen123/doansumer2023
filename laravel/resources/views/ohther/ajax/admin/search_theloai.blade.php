@php
$i = 0;
@endphp
@foreach ($list_theloai as $key => $item_theloai)
@php
    $i++;
@endphp
<tr data-expanded="true" class="theloai-item">
    <td>{{ $i }}</td>
    <td>
        {{ $item_theloai->category_name }}


    </td>
    <td>{{ $item_theloai->phanloai_name }}</td>
    <td class="d-flex  align-items-center">
        <div style="min-height: 35px" class="img_child"><img class="img_child_icon"
                src="{{ $item_theloai->theloai_link_img }}" alt="">
            {{ $item_theloai->theloai_name }}</div>
    </td>
    <td style="text-align: center" data-value="{{ $item_theloai->theloai_status }}">
        @if ($item_theloai->theloai_status == 1)
            <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
        @elseif($item_theloai->theloai_status == 0)
            <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
        @endif
    </td>

    <td>
        <div class="flex_center icons">
            <div class="icon bg-bule flex_center">
                <a
                    href="{{ route('theloai_update', ['theloai_id' => $item_theloai->theloai_id]) }}">
                    <i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="icon bg-red flex_center">
                @if ($item_theloai->theloai_status == 1)
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái tắt không?')"
                        href="{{ route('togggle_status_theloai', ['theloai_id' => $item_theloai->theloai_id, 'theloai_status' => 1]) }}"><i
                            class="fa-solid fa-toggle-on"></i></a>
                @else
                    <a onclick="return confirm('Bạn có muốn chuyển phân loại này sang trạng thái bật không ?')"
                        href="{{ route('togggle_status_theloai', ['theloai_id' => $item_theloai->theloai_id, 'theloai_status' => 0]) }}"><i
                            class="fa-solid fa-toggle-off"></i></a>
                @endif
            </div>
        </div>
    </td>
</tr>
@endforeach