$(document).ready(function() {
    $('#search_icon').click(function(){
        $('#search_input').toggle();   
    })
    $('#search_ajax_category').keyup(function(){
      var content= $('#search_ajax_category').val();
      console.log(content);
      $.ajax({
        type: "GET",
        url: "",
        data:{
          bien:search_inputs_nv
        },
        success: function(data) {
         $('#category_list_table').html(data);
        },
    
      });
    })
})

    window.addEventListener('DOMContentLoaded', function() {
        var blocks = document.querySelectorAll('.block');
        var maxWidth = 0;

        // Tìm chiều rộng lớn nhất
        blocks.forEach(function(block) {
            var width = block.clientWidth;
            if (width > maxWidth) {
                maxWidth = width;
            }
        });

        // Áp dụng chiều rộng lớn nhất cho tất cả các phần tử
        blocks.forEach(function(block) {
            block.style.width = maxWidth + 'px';
        });
    });
