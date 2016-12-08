$( document ).ready(function() {
    
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
    
    //Скрипт поиска
    var searchCount = 0;
    $('.fa-search').click(function() {
        if (searchCount % 2 == 0) {
            $('.search-box input').addClass('fadein');
        }
        else {
            $('.search-box input').removeClass('fadein');
        }
        searchCount++;
    });

});