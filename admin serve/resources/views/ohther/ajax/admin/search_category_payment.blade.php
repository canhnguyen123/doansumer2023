@foreach ($list_category_payment as $key =>$item_payment_list )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="status_payment-item">
            <td colspan="1">
              @if ($check==0)
                {{$i}}
              @else
                 {{ $i + $list_category_payment->firstItem() - 1 }}
              @endif
             </td>
            <td colspan="3">  {{$item_payment_list->category_payment_name}}</td>
            <td colspan="3" >  {{$item_payment_list->category_payment_note}}</td>
            <td colspan="1"  style="text-align: center">
            @if ($item_payment_list->category_payment_status == 1)
                <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
            @elseif($item_payment_list->category_payment_status == 0)
                <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
            @endif
            </td>
             <td colspan="2" ><div class="flex_center icons">
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('category_payment_update', ['category_payment_id' => $item_payment_list->category_payment_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                  @if ($item_payment_list->category_payment_status == 1)
                      <a onclick="return confirm('Bạn có muốn chuyển p sang trạng thái tắt không?')"
                          href="{{ route('togggle_category_payment', ['category_payment_id' => $item_payment_list->category_payment_id, 'category_payment_status' => 1]) }}"><i
                              class="fa-solid fa-toggle-on"></i></a>
                  @else
                      <a onclick="return confirm('Bạn có muốn chuyển trạng thái bật không ?')"
                          href="{{ route('togggle_category_payment', ['category_payment_id' => $item_payment_list->category_payment_id, 'category_payment_status' => 0]) }}"><i
                              class="fa-solid fa-toggle-off"></i></a>
                  @endif
              </div>
            </div></td>
          </tr>
          @endforeach