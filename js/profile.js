$( document ).ready(function() {    

$(document).on('click', '#my_comments', function(e){
    e.preventDefault();
    
    var $that = $(this),
        fData = $that.serialize(); // сериализируем данные
    var userName = $(document).find('#personal-data').attr('username');
    
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              form_data: fData, 
              username: userName              
          },
          dataType: 'json',
          success: function(json){
              
            // В случае успешного завершения запроса...
            if(json){
                $('#personal-data').replaceWith(json); 
                
            }
          },
          error: function(xhr, status, error){
            console.log("comment_error");
            console.log(xhr.responseText);
            
          }
        });
      
      
  });
    
    
});