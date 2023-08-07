@foreach ($list_cmt as $item_cmt)
<div class="item-commet" data-id="{{ $item_cmt->mess_parent_comment_id }}">
  
        <div class="img-user flex_center">
            <img src="https://firebasestorage.googleapis.com/v0/b/loco-7d8c6.appspot.com/o/2304226.png?alt=media&token=344cb26d-7070-48a9-b8bd-b6646030858c" alt="">
        </div>
  
    <div class="infro-user">
        <div class="content-cmt">
                <div class="infro-user-name">Quản trị viên</div>
            <div class="infro-user-text">{{ $item_cmt->cmt_text }}</div>
            <div class="reply-cmt-post">
                <p data-id="{{ $item_cmt->cmt_id }}">Trả lời</p>
            </div>
        </div>
    </div>
</div>

@endforeach