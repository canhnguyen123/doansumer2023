@foreach ($staff as $key =>$item_staff )
      @php
      $i++;
      @endphp
          <tr data-expanded="true" class="staff-item">
            <td>
              @if ($check==0)
                {{$i}}
              @else
                 {{ $i + $staff->firstItem() - 1 }}
              @endif
             </td>
            <td>  {{$item_staff->staff_code}}</td>
            <td>  {{$item_staff->staff_fullname}}</td>
            <td style="text-align: center">
                            @if($item_staff->staff_status==1)
              
              <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
              @elseif($item_staff->phanloai_status==0)
              <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
              @endif   
            </td>
             <td ><div class="flex_center icons">
              <div class="icon bg-yellow flex_center">
                <a href="{{ route('staff_deteal', ['staff_id' => $item_staff->id]) }}"><i class="fa-solid fa-eye"></i></a> 
               </div>
                <div class="icon bg-bule flex_center">
                 <a href="{{ route('staff_update', ['staff_id' => $item_staff->id]) }}"> <i class="fa-solid fa-pen"></i></a> 
                </div>
                <div class="icon bg-red flex_center">
                  @if ($item_staff->staff_status == 1)
                      <a onclick="return confirm('Bạn có muốn chuyển voucher này sang trạng thái tắt không?')"
                          href="{{ route('togggle_status_staff', ['staff_id' => $item_staff->id,'staff_status' => 1]) }}"><i
                              class="fa-solid fa-toggle-on"></i></a>
                  @else
                      <a onclick="return confirm('Bạn có muốn chuyển phân loại baner này sang trạng thái bật không ?')"
                          href="{{ route('togggle_status_staff', ['staff_id' => $item_staff->id, 'staff_status' => 0]) }}"><i
                              class="fa-solid fa-toggle-off"></i></a>
                  @endif
              </div>
            </div></td>
          </tr>
          @endforeach