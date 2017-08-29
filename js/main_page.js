$( document ).ready(function() {    

/* Первый запуск главной страницы */    
    
    $(document).on('ready', function(){
     
        $.ajax({
          url: "models/main_page/main_page_gallery.php", 
          type: "POST",
          data: {
              
          },
          dataType: 'json',
          success: function(json){
            $('#articlesGallery').replaceWith(json); // заменим форму данными, полученными в ответе
            console.log("articles_loaded");
            
          },
          error: function(xhr, status, error){
              console.log(xhr.responseText);;
          }
        });
        
    });
    
});