     @php
          $i = 0;
         @endphp
      @foreach ($payment_list as $key =>$item_payment )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="status_payment-item">
            <td>{{ $i }}</td>
            <td> 
              @if ($item_payment->hoadon_code=="")
                Chưa tạo hóa đơn   
              @else
                {{$item_payment->hoadon_code}}
              @endif
            </td>
            <td> {{ number_format($item_payment->hoadon_allprice, 0, '.', ',') }} VNĐ</td>
             <td ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{route('payment_deatil',['hoadon_id'=>$item_payment->hoadon_id ])}}"> <i class="fa-solid fa-eye"></i></a> 
                </div>
            </div></td>
          </tr>
          @endforeach
      
          
