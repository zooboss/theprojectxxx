$( document ).ready(function() {    

    
//Кликабельные строки таблиц
    
$(document).on('click', '.clickable-row', function(e) {
    
    window.location = $(this).attr("data-href");
    
});
    
    
    
//Мои комментарии    
    
$(document).on('click', '#my_comments', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "my_comments", 
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
    
//    
    
//Мои ответы
    
    
    
    
    
    
    
    
    
    
});