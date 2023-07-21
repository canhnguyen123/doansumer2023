@php
$i = 0;
@endphp
@foreach ($list_phanquyenDeatil as $key =>$item_phanquyen )
@php
$i++;
@endphp
<tr data-expanded="true">
  <td>{{ $i }}</td>
 <td>{{ $item_phanquyen->phanquyen_nameGroup}}</td>
 <td>{{ $item_phanquyen->phanquyenDeatil_name}} ({{ $item_phanquyen->phanquyenDeatil_route}})</td>
   <td style="text-align: center;"> 
       @if ($item_phanquyen->phanquyenDeatil_status == 1)
          <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
      @elseif($item_phanquyen->phanquyenDeatil_status == 0)
          <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
      @endif
  </td>
  <td ><div class="flex_center icons">
    <div class="icon bg-bule flex_center">
      <a href="{{ route('phanquyenDeatil_update', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id]) }}"> <i class="fa-solid fa-pen"></i></a> 
     </div>
     <div class="icon bg-red flex_center">
         
          @if ($item_phanquyen->phanquyenDeatil_status== 1)
          <a onclick="return confirm('Bạn có muốn chuyển voucher này sang trạng thái tắt không?')"
              href="{{ route('togggle_status_phanquyenDeatl', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id,'phanquyenDeatil_status' => 1]) }}"><i
                  class="fa-solid fa-toggle-on"></i></a>
        @else
          <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
              href="{{ route('togggle_status_phanquyenDeatl', ['phanquyenDeatil_id' => $item_phanquyen->phanquyenDeatil_Id,'phanquyenDeatil_status' => 0]) }}"><i
                  class="fa-solid fa-toggle-off"></i></a>
         @endif
     
        </div>
  </div></td>
</tr>
@endforeach

