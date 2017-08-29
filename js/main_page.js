$( document ).ready(function() {    

/* Первый запуск главной страницы */    
    var articlesInBlock = 11;
    var blockNumber = 1;
    var maxBlockNumber = (Math.floor( $('#articlesGallery').attr('count-articles') / articlesInBlock) + 1);
    var blockChange;
    var timer;
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
        
        /* убирает сообщение об ошибке изза попытки считать элемент, который аякс ещё не успел подгрузить */
            try {var elemTop = $(elem).offset().top;} 
            catch(err){}
            try {var elemBottom = elemTop + $(elem).height();} 
            catch(err){}
       /* убирает сообщение об ошибке изза попытки считать элемент, который аякс ещё не успел подгрузить */
        return((elemBottom <= docViewBottom));
         
    }
    
    $(document).on("scroll", function(e){
        /*
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function(){
                    blockChange = element_in_scroll('#block-'+blockNumber);
                }, 100);
        
        */
        blockChange = element_in_scroll('#block-'+blockNumber);
        if (blockNumber <= maxBlockNumber){
            if(blockChange == true){
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