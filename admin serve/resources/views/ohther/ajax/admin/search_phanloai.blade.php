@foreach ($phanloai as $item_phanloai)
@php
      $i++;
      @endphp
<tr data-expanded="true">
    <td>
      @if ($check==0)
      {{$i}}
    @else
    {{ $i + $phanloai->firstItem() - 1 }}
    @endif
      </td>
    <td>{{ $item_phanloai->phanloai_name }}</td>
    <td style="text-align: center">{{ $item_phanloai->phanloai_code }}</td>
    <td style="text-align: center">
      @if($item_phanloai->phanloai_status==1)
      <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
      @elseif($item_phanloai->phanloai_status==0)
      <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
      @endif
   
      
      
    </td>
    
    <td ><div class="flex_center icons">
        <div class="icon bg-bule flex_center">
         <a href="{{ route('phanloai_update', ['phanloai_id' => $item_phanloai->phanloai_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
        </div>
        <div class="icon bg-red flex_center">
          @if ($item_phanloai->phanloai_status==1)
          <a onclick="return confirm('Bạn có muốn chuyển danh mục này sang trạng thái tắt không?')" href="{{ route('togggle_status_phanloai', ['phanloai_id' => $item_phanloai->phanloai_id, 'phanloai_status' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
          @else
          <a onclick="return confirm('Bạn có muốn chuyển danh mục này sang trạng thái bật không ?')" href="{{ route('togggle_status_phanloai', ['phanloai_id' => $item_phanloai->phanloai_id,'phanloai_status'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
         @endif
        </div>
    </div></td>
  </tr>
@endforeach
