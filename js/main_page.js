$( document ).ready(function() {    

    var articlesInBlock = 6,
        cathegoryType = "main",
        maxBlockNumber = (Math.floor( $('#articlesGallery').attr('count-articles') / articlesInBlock) + 1),
        blockChange;
 
    
//Отрисовка статей
    
    function renderArticles(e, initial){
        e.preventDefault();
        $("#everywhere-top-navigation-menu li").removeClass("selected");
        $(this).parent().addClass("selected");    
    //ресет страницы при смене закладки
        
        $("body").animate({ scrollTop: "0px" });
        blockNumber = 1;
                
        if (!initial) cathegoryType = $(this).attr("cathegory-type");
        
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
                $('#articlesGallery').append(json);
                $('#block-'+blockNumber).show('slow');
                console.log("success");  

              },
              error: function(xhr, status, error){
                  console.log(xhr.responseText);;
              }
                
        });   
    }
               
    $(document).on('ready', function(e){
        renderArticles(e, true);
        
            
    });           
               
               
    
/*    
    
    $(document).on('click', "#everywhere-top-navigation-menu li a", function(e){
    //смена активной ссылки
        e.preventDefault();
        $("#everywhere-top-navigation-menu li").removeClass("selected");
        $(this).parent().addClass("selected");    
    //ресет страницы при смене закладки
        container.animate({
                    scrollTop: scrollTo.offset().top
                });
        blockNumber = 1;
        
        currentRequest = "request_cathegory";
        cathegoryType = $(this).attr("cathegory-type");
        
        $.ajax({
          
          url: "models/main_page/main_page_gallery.php", 
          type: "POST",
          data: {
              currentRequest: currentRequest,
              requestType: "cathegory_request",
              cathegoryType: cathegoryType,
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

    
    
*/    
    
    
    
    
    
    
    
    
});