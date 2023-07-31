@foreach ($phanquyen as $key =>$item_phanquyen )
@php
$i++;
@endphp
    <tr data-expanded="true">
      <td>
        @if ($check==0)
          {{$i}}
        @else
           {{ $i + $phanquyen->firstItem() - 1 }}
        @endif
       </td>
      <td>{{ $item_phanquyen->phanquyen_nameGroup}}</td>
      <td>{{ $item_phanquyen->phanquyen_note}}</td>
      <td ><div class="flex_center icons">
        <div class="icon bg-bule flex_center">
          <a href="{{ route('phanquyen_update', ['phanquyen_id' => $item_phanquyen->phanquyen_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
         </div>
         <div class="icon bg-red flex_center">
             
              @if ($item_phanquyen->phanquyen_status== 1)
              <a onclick="return confirm('Bạn có muốn chuyển voucher này sang trạng thái tắt không?')"
                  href="{{ route('togggle_status_phannuyen', ['phanquyen_id' => $item_phanquyen->phanquyen_id,'phanquyen_status' => 1]) }}"><i
                      class="fa-solid fa-toggle-on"></i></a>
            @else
              <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
                  href="{{ route('togggle_status_phannuyen', ['phanquyen_id' => $item_phanquyen->phanquyen_id,'phanquyen_status' => 0]) }}"><i
                      class="fa-solid fa-toggle-off"></i></a>
             @endif
         
            </div>
      </div></td>
    </tr>
    @endforeach