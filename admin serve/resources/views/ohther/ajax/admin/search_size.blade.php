@foreach ($size as $key =>$item_size )
@php
$i++;
@endphp
<tr data-expanded="true">
  <td>
    @if ($check==0)
      {{$i++}}
    @else
       {{ $i + $size->firstItem() - 1 }}
    @endif
   </td>
  <td>{{ $item_size->name_size }}</td>
  <td style="text-align: center" >{{ $item_size->describle_size }}</td>
  <td style="text-align: center">
    <p class="reslut_categgory_icon" style="display: none">{{ $item_size->status_size }}</p>
    @if($item_size->status_size==1)
    
    <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
    @elseif($item_size->status_size==0)
    <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
    @endif
 
    
    
  </td>
  
  <td ><div class="flex_center icons">
      <div class="icon bg-bule flex_center">
       <a href="{{ route('size_update', ['id_size' => $item_size->id_size]) }}"> <i class="fa-solid fa-pen"></i></a> 
      </div>
      <div class="icon bg-red flex_center">
        @if ($item_size->status_size==1)
        <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái tắt không?')" href="{{ route('togggle_status_size', ['id_size' => $item_size->id_size, 'status_size' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
        @else
        <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái bật không ?')" href="{{ route('togggle_status_size', ['id_size' => $item_size->id_size,'status_size'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
       @endif                 
       </div>
  </div></td>
</tr>
@endforeach
