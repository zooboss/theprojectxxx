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
    
    //Скрипт логина
    /*
    var searchCount = 0;
    $('.header-profile-image').click(function() {
        if (searchCount % 2 == 0) {
            $('#login').addClass('fadein');
        }
        else {
            $('#login').removeClass('fadein');
        }
        searchCount++;
        console.log(searchCount);
    });
    */
    //Скрипт поиска
    
    $(".main-search").keydown(function(e){
        if(e.which == 13) {
            window.alert("enter");
        }
            
        
    });
    
    
    
    
/*
==================================================================================
==============Обработчик комментариев для article_page.php========================
=================================================================================
*/
    
    
    $('a.add_comment').click(function(){
        $('.popup, .overlay').css({'opacity': 1, 'visibility': 'visible'});

		var article = $(this).attr('article');
		$.ajax({ //отправляем ajax-запрос
            type: "POST", //тип (POST, GET, PUT, etc)
            url: "models/comments/comments_via_social.php", //УРЛ Вашего обработчика
            data: { 	
		      article_id: article
		    } //сами данные, передается POST[xmlUrl] со значением из data нажатой кнопки
        })
        .done(function( res ) { //при успехе (200 статус)
        	$('div.popup').html(res) //заменяем блок с id="div.popup" полученной строкой от сервера.
		    $('.popup .close_window, .overlay').click(function (){
                $('.popup, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
            });
        });
    
	});
    
    

});

