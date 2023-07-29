
@foreach ($color as $key =>$item_color )
@php  
$i++;
@endphp
<tr data-expanded="true">
  <td>
    @if ($check==0)
    {{$i++}}
  @else
  {{ $i + $color->firstItem() - 1 }}
  @endif
    </td>
  <td>{{ $item_color->color_name}}</td>
  <td style="text-align: center" >{{ $item_color->color_code}}</td>
  <td style="text-align: center">
    <p class="reslut_categgory_icon" style="display: none">{{ $item_color->color_status}}</p>
    @if($item_color->color_status==1)
    
    <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
    @elseif($item_color->color_status==0)
    <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
    @endif
 
    
    
  </td>
  
  <td ><div class="flex_center icons">
      <div class="icon bg-bule flex_center">
       <a href="{{ route('color_update', ['color_id' => $item_color->color_id ]) }}"> <i class="fa-solid fa-pen"></i></a> 
      </div>
      <div class="icon bg-red flex_center">
        @if ($item_color->color_status==1)
        <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái tắt không?')" href="{{ route('togggle_status_color', ['color_id' => $item_color->color_id, 'color_status' => 1]) }}"><i class="fa-solid fa-toggle-on"></i></a>
        @else
        <a onclick="return confirm('Bạn có muốn chuyển màu này sang trạng thái bật không ?')" href="{{ route('togggle_status_color', ['color_id' => $item_color->color_id,'color_status'=>0]) }}"><i class="fa-solid fa-toggle-off"></i></a> 
       @endif                </div>
  </div></td>
</tr>
@endforeach


