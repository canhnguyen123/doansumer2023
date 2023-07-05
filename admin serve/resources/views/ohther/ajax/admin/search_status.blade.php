@php
$i = 0;
@endphp
@foreach ($status as $key =>$item_status )
@php
$i++;
@endphp
<tr data-expanded="true">
  <td>{{ $i }}</td>
  <td>{{ $item_status->status_name }}</td>
  <td style="text-align: center" >{{ $item_status->status_code }}</td>
    <td ><div class="flex_center icons">
      <div class="icon bg-bule flex_center">
       <a href="{{ route('status_update', ['status_id' => $item_status->status_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
      </div>
      <div class="icon bg-red flex_center">
          <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('status_delete', ['status_id' => $item_status->status_id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
      </div>
  </div></td>
</tr>
@endforeach

