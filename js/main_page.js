$( document ).ready(function() {    

/* Первый запуск главной страницы */    
    var articlesInBlock = 6;
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
        console.log("elemTop " + elemTop);
        console.log("elemBottom " + elemBottom);
        console.log("view " + docViewBottom);
        console.log(elem);
        if(elem){
            if (elemBottom <= docViewBottom){
                return "append_bottom_block";
            }
            if (elemTop > docViewBottom){
                return "remove_bottom_block";
            }
        }
         
    }
    
    $(document).on("scroll", function(e){
        
        blockChange = element_in_scroll('#block-'+blockNumber);
        console.log(blockChange);
        if (blockNumber <= maxBlockNumber){
            switch (blockChange){
                case "append_bottom_block":
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

                       $('#articlesGallery').append(json);
                       $('#block-'+blockNumber).show('slow');  
                       if (blockNumber > maxBlockNumber){
                           blockNumber = maxBlockNumber;
                       }      

                      },
                      error: function(xhr, status, error){
                          console.log(xhr.responseText);;
                      }
                    });
                break;
            
                case "remove_bottom_block":
                    $('#block-'+blockNumber).remove();
                    blockNumber--;

                break;
            }
        }
    });
    
    
//Смена активной закладки
    
    $(document).on('click', "#everywhere-top-navigation-menu li a", function(e){
        e.preventDefault();
        $("#everywhere-top-navigation-menu li").removeClass("selected");
        $(this).parent().addClass("selected");    
        
        $.ajax({
          
          url: "models/main_page/main_page_gallery.php", 
          type: "POST",
          data: {
              requestType: "cathegory_request",
              cathegoryType: $(this).attr("cathegory-type"),
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});