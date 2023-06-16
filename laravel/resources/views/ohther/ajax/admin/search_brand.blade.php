@if(isset($brand))
@php
$i = 0;
@endphp
@foreach ($brand as $key =>$item_brand )
@php
$i++;
@endphp
    <tr data-expanded="true">
      <td>{{ $i }}</td>
      <td>{{ $item_brand->brand_name }}</td>
      <td style="text-align: center" >{{ $item_brand->brand_code }}</td>
      <td style="text-align: center">
        <p class="reslut_categgory_icon" style="display: none">{{ $item_brand->brand_status }}</p>
        @if($item_brand->brand_status==1)
        
        <i class="fa-sharp fa-solid fa-check bg-cl-green"></i>
        @elseif($item_brand->brand_status==0)
        <i class="fa-solid fa-xmark bg-cl-red" alt="Ẩn"></i>
        @endif
     
        
        
      </td>
      
      <td ><div class="flex_center icons">
          <div class="icon bg-bule flex_center">
           <a href="{{ route('brand_update', ['brand_id' => $item_brand->brand_id]) }}"> <i class="fa-solid fa-pen"></i></a> 
          </div>
          <div class="icon bg-red flex_center">
              <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ route('brand_delete', ['brand_id' => $item_brand->brand_id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a> 
          </div>
      </div></td>
    </tr>
    @endforeach
@else
  <tr> <td>Không có hàng nào</td></tr> 
@endif



