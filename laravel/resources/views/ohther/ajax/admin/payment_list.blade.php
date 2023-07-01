     @php
          $i = 0;
         @endphp
      @foreach ($payment_list as $key =>$item_payment )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="status_payment-item">
            <td>{{ $i }}</td>
            <td>  {{$item_payment->hoadon_code}}</td>
            <td>  {{$item_payment->hoadon_allprice}}</td>
             <td ><div class="flex_center icons">
                {{-- <div class="icon bg-bule flex_center">
                 <a href="{{ route('status_payment_update', ['status_payment_id' => $item_status_payment->status_payment_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div> --}}
            </div></td>
          </tr>
          @endforeach
      
          
