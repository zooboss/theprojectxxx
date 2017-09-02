$( document ).ready(function() {    

    
//Кликабельные строки таблиц
    
$(document).on('click', '.clickable-row', function(e) {
    
    window.location = $(this).attr("data-href");
    
});
    
 
//Непрочитанные статьи

$(document).on('click', '#articles_not_visited', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "articles_not_visited", 
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
    
$(document).on('click', '#my_replies', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "my_replies", 
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
  
    
//Личные сообщения
    
$(document).on('click', '#personal_messages', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "personal_messages", 
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
    
    
    
    
    
//Рейтинг
    
$(document).on('click', '#rating', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "rating", 
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

// Профиль другого пользователя //
    
// Написать сообщение //
   $(document).on('click', '#type_message', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "type_message", 
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
    
    
    
// Посмотреть комментарии //
    $(document).on('click', '#user_comments', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "user_comments", 
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
    
    
    
// Посмотреть статьи //
    $(document).on('click', '#user-articles', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "user-articles", 
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
    
    
    
// Рейтинг //
    $(document).on('click', '#user-rating', function(e){
    e.preventDefault();
    var userName = $(document).find('#personal-data').attr('username');
        
        $.ajax({
          url: "models/profile/profile.php", 
          type: "POST", //
          data: {
              personal_request_type: "user-rating", 
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