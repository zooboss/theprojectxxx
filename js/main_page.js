$( document ).ready(function() {    

/* Первый запуск главной страницы */    
    var articlesInBlock = 6;
    var blockNumber = 1;
    var maxBlockNumber = (Math.floor( $('#articlesGallery').attr('count-articles') / articlesInBlock) + 1);
    console.log(maxBlockNumber);
    $(document).on('ready', function(){
        
        
        $.ajax({
          
          url: "models/main_page/main_page_gallery.php", 
          type: "POST",
          data: {
              requestType: "initial_request",
              articlesInBlock: articlesInBlock
          },
          dataType: 'json',
          success: function(json){
            $('#articlesGallery').replaceWith(json); // заменим форму данными, полученными в ответе
            
            
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
        
        var what;
        if (elemBottom <= docViewBottom){
            what = true;
        } 
        else{
            what = false;
        }
        console.log(what);
        return((elemBottom <= docViewBottom));
         
    }
    
    $(document).on("scroll", function(e){
        if (blockNumber <= maxBlockNumber){
            if(element_in_scroll('#block-'+blockNumber) == true){
                blockNumber++;


                $.ajax({

                  url: "models/main_page/main_page_gallery.php", 
                  type: "POST",
                  data: {
                      requestType: "scroll_request",
                      blockNumber: blockNumber,
                      articlesInBlock: articlesInBlock
                  },
                  dataType: 'json',
                  success: function(json){
                    //$('#block-'+(blockNumber-1)).append(json);
                   $('#articlesGallery').append(json);

                  },
                  error: function(xhr, status, error){
                      console.log(xhr.responseText);;
                  }
                });

            }
        }
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});