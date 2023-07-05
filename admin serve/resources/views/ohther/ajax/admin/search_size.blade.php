@php
$i = 0;
@endphp
@foreach ($size as $key =>$item_size )
@php
$i++;
@endphp
<tr data-expanded="true">
  <td>{{ $i }}</td>
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
       <a href="{{ route('size_update', ['id_size' => $item_size->id_size ]) }}"> <i class="fa-solid fa-pen"></i></a> 
      </div>
      <div class="icon bg-red flex_center">
          <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('size_delete', ['id_size' => $item_size->id_size ]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
      </div>
  </div></td>
</tr>
@endforeach
