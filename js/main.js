var windowPreviousScrollPos = 0;

$( document ).ready(function() {
   
//Скрывает категориальные меню не на основной странице    
    var pathname = window.location.href;
    
    if (pathname != "http://localhost/theprojectxxx/index.php" && pathname != "http://localhost/theprojectxxx/"){
       $("#everywhere-top-navigation-menu").hide();
              
    }
        
    //Скрипт мобильного меню
    
    $('#menu-trigger').click(function() {
            $('#mySidenav').animate({"left": "+=200px", "opacity": "show"}, "slow");
            $('#menu-trigger').hide();
            $('#menu-close-trigger').show();
            $(".article-wrap").css({opacity:"0.3", backgroundColor:"#000" });
            $(".articlesGallery").css({opacity:"0.3", backgroundColor:"#000" });
        }
    );
    $('#menu-close-trigger').click(function() {
            $('#mySidenav').hide('slow');
            $('#menu-close-trigger').hide();
            $('#menu-trigger').show();
            $(".article-wrap").css({opacity:"1", backgroundColor:"transparent" });
            $(".articlesGallery").css({opacity:"1", backgroundColor:"transparent" });
        }
    );
    $('.mobile-menu-item').click(function() {
            $('#mySidenav').hide('slow');
            $('#menu-close-trigger').hide();
            $('#menu-trigger').show();
            $(".article-wrap").css({opacity:"1", backgroundColor:"transparent" });
            $(".articlesGallery").css({opacity:"1", backgroundColor:"transparent" });
        }
    );
    
    
  //Скрипт согласия с куками
    $("#cookie-accept").on('click', function(e){
        e.preventDefault();
        
        var cookieAccept = true; 
        $("#cookie-initial").hide('fast');
        
        document.cookie = "cookie_accept=John Smith";
        
               
    });
 
// Скрипт высплывающего хедера
    
    function scroll_direction(){
        var windowCurrentScrollPos = $(window).scrollTop();
                
        if( windowCurrentScrollPos >  windowPreviousScrollPos ) {
            return "bottom_direction";
        }
        else {
            return "top_direction"
        }
              
    }
    
    $(document).on( 'scroll', function(e){
        scrollDirection = scroll_direction();
        
        switch ( scrollDirection ) {
            case "bottom_direction":
                $(".total-header").addClass("header-move-top");
            break;
            
            case "top_direction":
                $(".total-header").removeClass("header-move-top");
            break;    
        }
        
        windowPreviousScrollPos = $(window).scrollTop();
        
    });
    
    
    
    
    
    
});





