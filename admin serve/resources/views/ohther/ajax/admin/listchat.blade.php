@foreach ($list_chat as $itemchat)
  @if ($itemchat->staff_id!== null)
  <div class="item-chat-mess-right">
    <p>{{$itemchat->chat_text}}</p>
  </div>
  @else
  <div class="item-chat-mess-left">
    <p>{{$itemchat->chat_text}}</p>
  </div>
  @endif

@endforeach