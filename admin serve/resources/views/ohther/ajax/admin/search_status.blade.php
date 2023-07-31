
@foreach ($status as $key =>$item_status )
@php
$i++;
@endphp
<tr data-expanded="true">
  <td>  @if ($check==0)
    {{$i}}
  @else
  {{ $i + $status->firstItem() - 1 }}
  @endif</td>
  <td>{{ $item_status->status_name }}</td>
  <td style="text-align: center" >{{ $item_status->status_code }}</td>
    <td ><div class="flex_center icons">
      <div class="icon bg-bule flex_center">
       <a href="{{ route('status_update', ['status_id' => $item_status->status_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
      </div>
  </div></td>
</tr>
@endforeach

