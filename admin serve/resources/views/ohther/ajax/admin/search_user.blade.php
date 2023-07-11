
     @foreach ($list_user as $key => $item_user)
      <tr data-expanded="true">
        <td>{{ $key + 1 }}</td>
        <td>{{ $item_user->user_fullname }}</td>
        <td>{{ $item_user->user_phone }}</td>
        <td>
          <div class="flex_center icons">
            <div class="icon bg-yellow flex_center">
              <a href="{{ route('user_deatil',['user_id'=>$item_user->user_id]) }}"><i class="fa-solid fa-eye"></i></a>
            </div>
            <div class="icon bg-red flex_center">
              @if ($item_user->user_status == 1)
              <a onclick="return confirm('Bạn có muốn bỏ khóa tài khoản này không?')"
                href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id, 'user_status' => 1]) }}"><i
                  class="fa-solid fa-toggle-on"></i></a>
              @else
              <a onclick="return confirm('Bạn có muốn tạm khóa tài khoản này không?')"
                href="{{ route('togggle_status_user', ['user_id' => $item_user->user_id, 'user_status' => 0]) }}"><i
                  class="fa-solid fa-toggle-off"></i></a>
              @endif
            </div>
          </div>
        </td>
      </tr>
      @endforeach


<button class="loadmore" id="load_more">Xem thêm</button>
