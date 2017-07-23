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

    

/* Первый запуск страницы статьи */    
    
    $(document).on('ready', function(){
                        
        var articleId = $(document).find('#comments').attr('index');
        var userLogged = $(document).find('#comments').attr('user_logged');
        var publicUserName = $(document).find('#comments').attr('public_user_name');
        var savedComment = '';
        if (window.sessionStorage.getItem("saved_comment") != '') {
            savedComment = window.sessionStorage.getItem("saved_comment");
            window.sessionStorage.setItem("saved_comment", '');
        }
        
        console.log("saved comment" + savedComment);
        
        $.ajax({
          url: "models/comments/comments_edit.php", // путь к обработчику берем из атрибута action
          type: "POST", // метод передачи - берем из атрибута method
          data: {
              article_id: articleId,
              public_user_name: publicUserName,
              user_logged: userLogged,
              saved_comment: savedComment
          },
          dataType: 'json',
          success: function(json){
            console.log("first-comments");
            $('#comments').replaceWith(json); // заменим форму данными, полученными в ответе
          },
          error: function(xhr, status, error){
              console.log(xhr.responseText);;
          }
        });
        
    });


/* В случае неавторизованного пользователя
   
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
 */
    
    $(document).on('submit', '#unlogged_form', function(e){
        e.preventDefault();
        console.log("unlogged comment form");
        
        var comment = $(this).find('textarea').val().trim();
        console.log(comment);
        window.sessionStorage.setItem("saved_comment", comment);
        var savedCommentCheck = window.sessionStorage.getItem("saved_comment");
        console.log(savedCommentCheck);
    });
    
     
/* В случае авторизованного пользователя */


  $(document).on('submit', '#my_form', function(e){
      console.log("comment_sent");
    e.preventDefault();
	var textarea = $("textarea[name='comment']");
    var $that = $(this),
        fData = $that.serialize(); // сериализируем данные
    var articleId = $(document).find('#comments').attr('index'),
        userLogged = $(document).find('#comments').attr('user_logged'),
        publicUserName = $(document).find('#comments').attr('public_user_name');
     var savedComment = '';
        if (window.sessionStorage.getItem("saved_comment") != '') {
            savedComment = window.sessionStorage.getItem("saved_comment");
            window.sessionStorage.setItem("saved_comment", '');
        }
        // ИЛИ
        // fData = $that.serializeArray();
    var emptyCheck = emptyCheck = $that.find('textarea').val();     //проверка пустого поля
        console.log(emptyCheck);
      if (emptyCheck != "" && emptyCheck != null){
        $.ajax({
          url: $that.attr('action'), // путь к обработчику берем из атрибута action
          type: $that.attr('method'), // метод передачи - берем из атрибута method
          data: {
              form_data: fData, 
              article_id: articleId,
              public_user_name: publicUserName,
              user_logged: userLogged,
              saved_comment: savedComment
              
          },
          dataType: 'json',
          success: function(json){
              console.log("comment_success");
            // В случае успешного завершения запроса...
            if(json){
                $('#comments').replaceWith(json); // заменим форму данными, полученными в ответе
                //$('#my_form').toggle();
                textarea.val('');
                //$('#showform').show();
            }
          },
          error: function(xhr, status, error){
            console.log("comment_error");
            console.log(xhr.responseText);
            
          }
        });
      }
      else {
         console.log("empty textarea - no ajax");
      }
  });


/* Вывод нового комментария после добавленного */


  $(document).on('click', '#showform', function(showForm){
    showForm.preventDefault();

		//$('#my_form').toggle();
		//$('#showform').hide();

		$('#comment_info').remove();
		$('#comments').replaceWith(json);
		
  });
    
    
/* Визуализация "ответить" */ 
$(document).on('click', '.reply', function(){
    console.log($(this).parent().parent().parent().index());
    if ( $(this).parent().find('form').hasClass('form-hidden') == 1 ) {
        
        $(this).parent().find('form').removeClass('form-hidden');
    }
    else {
        $(this).parent().find('form').addClass('form-hidden');
    }
    
    
    
});    
  
    
    
    
    
});





