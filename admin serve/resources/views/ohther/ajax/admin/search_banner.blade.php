@foreach ($list_banner as $key =>$item_banner )
@php
$i++;
@endphp
    <tr data-expanded="true" class="banner-item">
      <td>
        @if ($check==0)
        {{$i}}
      @else
      {{ $i + $list_banner->firstItem() - 1 }}
      @endif
        </td>
      <td  class="d-flex  align-items-center">
        <div style="min-height: 35px" class="img_child"><img class="img_child_icon" src="{{ $item_banner->banner_link }}" alt=""> 
          {{ $item_banner->banner_note }}</div> </td>
      <td style="text-align: center"  data-value="{{ $item_banner->banner_status }}">
        @if($item_banner->banner_status==1)
         <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
        @elseif($item_banner->banner_status==0)
        <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
        @endif
        </td>
      
      <td ><div class="flex_center icons">
          <div class="icon bg-bule flex_center">
           <a href="{{ route('banner_update', ['banner_id' => $item_banner->banner_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
          </div>
          <div class="icon bg-red flex_center">
              <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('banner_delete', ['banner_id' => $item_banner->banner_id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
          </div>
          <div class="icon bg-red flex_center">
            @if ($item_banner->banner_status == 1)
                <a onclick="return confirm('Bạn có muốn chuyển banner này sang trạng thái tắt không?')"
                    href="{{ route('togggle_status_banner', ['banner_id' => $item_banner->banner_id, 'banner_status' => 1]) }}"><i
                        class="fa-solid fa-toggle-on"></i></a>
            @else
                <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
                    href="{{ route('togggle_status_banner', ['banner_id' => $item_banner->banner_id, 'banner_status' => 0]) }}"><i
                        class="fa-solid fa-toggle-off"></i></a>
            @endif
        </div>
      </div></td>
    </tr>
    @endforeach
