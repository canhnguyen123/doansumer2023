@php
$i = 0;
@endphp
@foreach ($color as $key =>$item_color )
@php  
$i++;
@endphp
<tr data-expanded="true">
  <td>{{ $i }}</td>
  <td>{{ $item_color->color_name }}</td>
  <td style="text-align: center" >{{ $item_color->color_code }}</td>
  <td style="text-align: center">
    <p class="reslut_categgory_icon" style="display: none">{{ $item_color->color_status }}</p>
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
          <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('color_delete', ['color_id' => $item_color->color_id ]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
      </div>
  </div></td>
</tr>
@endforeach


