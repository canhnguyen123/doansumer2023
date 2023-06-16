var editors = document.querySelectorAll('.editor');
for (var i = 0; i < editors.length; i++) {
    CKEDITOR.replace(editors[i], {
        enterMode: CKEDITOR.ENTER_BR,  // Sử dụng dòng mới thay vì thẻ <p></p>
        shiftEnterMode: CKEDITOR.ENTER_P,  // Sử dụng thẻ <p></p> khi nhấn Shift + Enter
        removePlugins: 'div,autolink'  // Loại bỏ plugin div và autolink
    });
}
