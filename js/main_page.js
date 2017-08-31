$( document ).ready(function() {    

    var articlesInBlock = 6,
        cathegoryType = "main",
        maxBlockNumber = (Math.floor( $('#articlesGallery').attr('count-articles') / articlesInBlock) + 1),
        blockChange;
 
    
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
                $('#block-'+blockNumber).remove();  
                $('#articlesGallery').append(json);
                $('#block-'+blockNumber).show('slow');
                console.log("success");
              },
              error: function(xhr, status, error){
                  console.log(xhr.responseText);;
              }
                
        });   
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

    
    
    
    
    
    
    
    
    
    
    
});