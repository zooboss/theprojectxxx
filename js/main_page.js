$( document ).ready(function() {    

/* Первый запуск главной страницы */    
    
    $(document).on('ready', function(){
        var articlesInBlock = 11;
        
        $.ajax({
          
          url: "models/main_page/main_page_gallery.php", 
          type: "POST",
          data: {
              articlesInBlock: articlesInBlock
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
    
    /* INFINITE SCROLL  */
     function element_in_scroll(elem){
         var docViewTop = $(window).scrollTop();
         var docViewBottom = docViewTop + $(window).height();
         
         var elemTop = $(elem).offset().top;
         var elemBottom = elemTop + $(elem).height();
         
         return((elemBottom <= docViewBottom));
         
     }
    
    $(document).on("scroll", function(e){
       console.log(element_in_scroll(".columns"));
        
        
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});