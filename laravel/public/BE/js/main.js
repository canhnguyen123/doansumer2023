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
