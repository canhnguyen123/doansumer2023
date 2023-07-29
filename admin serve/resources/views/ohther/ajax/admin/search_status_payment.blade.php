@foreach ($status_payment as $key =>$item_status_payment )
@php
$i++;
@endphp
    <tr data-expanded="true" class="status_payment-item">
      <td>
        @if ($check==0)
          {{$i++}}
        @else
           {{ $i + $status_payment->firstItem() - 1 }}
        @endif
       </td>
      <td>  {{$item_status_payment->status_payment_name}}</td>
      <td>  {{$item_status_payment->status_payment_note}}</td>
       <td ><div class="flex_center icons">
          <div class="icon bg-bule flex_center">
           <a href="{{ route('status_payment_update', ['status_payment_id' => $item_status_payment->status_payment_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
          </div>
      </div></td>
    </tr>
    @endforeach
