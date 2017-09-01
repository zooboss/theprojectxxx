$( document ).ready(function() {    

    var articlesInBlock = 11,
        masterKey = 0,
        cathegoryType = "main",
        maxBlockNumber = (Math.floor( $('#articlesGallery').attr('max-block-number') / articlesInBlock) + 1),
        blockChange,
        blockNumber;
 
    
//Отрисовка статей
    
    function renderArticles(event, initial, element){
        event.preventDefault();
        
        if (!initial) {
            $("#everywhere-top-navigation-menu li").removeClass("selected");
            element.parent().addClass("selected");  
            cathegoryType = element.attr("cathegory-type");
            console.log(cathegoryType);
        }  
    //ресет страницы при смене закладки
        
        $("body").animate({ scrollTop: "0px" });
        masterKey = 0;
        blockNumber = 1;
                
        $.ajax({
          
              url: "models/main_page/main_page_gallery.php", 
              type: "POST",
              data: {
                  blockNumber: blockNumber,
                  requestType: "cathegory_request",
                  cathegoryType: cathegoryType,
                  articlesInBlock: articlesInBlock
              },
              dataType: 'json',
              success: function(json){
                $('#articlesGallery').find('#site-search').remove();
                $('#block-'+blockNumber).remove();  
                $('#articlesGallery').append(json);
                $('#block-'+blockNumber).show('slow');
                console.log("success");
                  
//Смена максимума блоков при смене категории     
                  
                maxBlockNumber = $('.columns').attr('max-block-number');      
              },
              error: function(xhr, status, error){
                  console.log(xhr.responseText);;
              }
                
        });   
    }
    
    function element_in_scroll(elem){
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        
        /* убирает сообщение об ошибке изза попытки считать элемент, который аякс ещё не успел подгрузить */
            try {var elemTop = $(elem).offset().top;} 
            catch(err){}
            try {var elemBottom = elemTop + $(elem).height();} 
            catch(err){}
       /* убирает сообщение об ошибке изза попытки считать элемент, который аякс ещё не успел подгрузить */
       
        if(elem){
            if (elemBottom <= docViewBottom){
                return "append_bottom_block";
            }
            if (elemTop > docViewBottom){
                return "remove_bottom_block";
            }
        }
         
    }
    
    
//Первый запуск
    
    $(document).on('ready', function(e){
        renderArticles(e, true);
            
    });           
               
//Смена категории
     
    
    $(document).on('click', "#everywhere-top-navigation-menu li a", function(e){
        elem = $(this);
        renderArticles(e, false, elem);
        
    });
//Скролл
    
    $(document).on("scroll", function(e){
        masterKey = $("#block-" + blockNumber).find(".article-wrap:last-child").attr("master-key");
       
        console.log("mK: " + masterKey);
        blockChange = element_in_scroll('#block-'+blockNumber);
        
        
        //console.log(maxBlockNumber + " " + blockNumber);
        if (blockNumber < maxBlockNumber){
            switch (blockChange){
                case "append_bottom_block":
                    blockNumber++;
                    
                    $.ajax({

                      url: "models/main_page/main_page_gallery.php", 
                      type: "POST",
                      data: {
                          requestType: "cathegory_request",
                          cathegoryType: cathegoryType,
                          blockNumber: blockNumber,
                          articlesInBlock: articlesInBlock,
                          masterKey: masterKey
                      },
                      dataType: 'json',
                      success: function(json){

                       $('#articlesGallery').append(json);
                       $('#block-'+blockNumber).show('slow');  
                           

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
        if( (blockNumber == maxBlockNumber) && (blockChange == "remove_bottom_block") ) {
            $('#block-'+blockNumber).remove();
            blockNumber--;
        }
        
    });

   
//Поиск
    $("#input-search").on("keyup", function(e){
        if(e.which == 13) {
            e.preventDefault();
            var searchPhrase = e.target.value;
            $.ajax({
                url: "models/main_page/main_page_gallery.php", 
                      type: "POST",
                      data: {
                          searchPhrase: searchPhrase,
                          requestType: "search_request",
                          cathegoryType: cathegoryType,
                          blockNumber: blockNumber,
                          articlesInBlock: articlesInBlock,
                          masterKey: masterKey
                      },
                      dataType: 'json',
                      success: function(json){
                            
                       $('#articlesGallery').find('div').remove();
                       $('#articlesGallery').append(json);     
                           

                      },
                      error: function(xhr, status, error){
                          console.log(xhr.responseText);;
                      }
                
                
                
            });
          
        
        }
        
    });
    
    
    

    
    
    
    
    
    
});