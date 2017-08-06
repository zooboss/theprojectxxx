/*
==================================================================================
==============Обработчик комментариев для article_page.php========================
=================================================================================
*/

$( document ).ready(function() {    

/* Первый запуск страницы статьи */    
    
    $(document).on('ready', function(){
        
        /* Блок реакции на якорную ссылку */
            var url = window.location.href;
            if (url.indexOf('#') > -1) {
                 var replyAnchor = url.split('#').pop();
            }
                  
        /* Блок реакции на якорную ссылку */  
        
        var articleId = $(document).find('#comments').attr('index');
        var userLogged = $(document).find('#comments').attr('user_logged');
        var publicUserName = $(document).find('#comments').attr('public_user_name');
        var savedComment = '',
            savedCommentId = null;
        if (window.sessionStorage.getItem("saved_comment") != '') {
            savedComment   = window.sessionStorage.getItem("saved_comment");
            savedCommentId = window.sessionStorage.getItem("saved_comment_id");
            
        }
        
        console.log("saved comment " + savedComment + " " + savedCommentId);
        
        $.ajax({
          url: "models/comments/comments_edit.php", // путь к обработчику берем из атрибута action
          type: "POST", // метод передачи - берем из атрибута method
          data: {
              article_id: articleId,
              public_user_name: publicUserName,
              user_logged: userLogged,
              saved_comment: savedComment,
              saved_comment_id: savedCommentId
          },
          dataType: 'json',
          success: function(json){
            $('#comments').replaceWith(json); // заменим форму данными, полученными в ответе
            $('[comment-id='+savedCommentId+'] form:first-of-type').removeClass("form-hidden");  
            /* Блок реакции на якорную ссылку */
              if (replyAnchor != "" && replyAnchor != null){
                
                var container = $('body');
                var scrollTo = $('#' + replyAnchor);
                container.animate({
                    scrollTop: scrollTo.offset().top
                });
            }
            /* Блок реакции на якорную ссылку */    
          },
          error: function(xhr, status, error){
              console.log(xhr.responseText);;
          }
        });
        window.sessionStorage.setItem("saved_comment", '');
        window.sessionStorage.setItem("saved_comment_id", null);
        
    });


/* В случае неавторизованного пользователя */
           
    $(document).on('submit', '#unlogged_form', function(e){
        e.preventDefault();
        var comment = $(this).find('textarea').val().trim();
        var commentId = $(this).parent().parent().parent().attr('comment-id');
        window.sessionStorage.setItem("saved_comment", comment);
        window.sessionStorage.setItem("saved_comment_id", commentId);
        
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
     /*var savedComment = '';
        if (window.sessionStorage.getItem("saved_comment") != '') {
            savedComment = window.sessionStorage.getItem("saved_comment");
            window.sessionStorage.setItem("saved_comment", '');
        } */
        // ИЛИ
        // fData = $that.serializeArray();
    var emptyCheck = emptyCheck = $that.find('textarea').val();     //проверка пустого поля    
    var replyToId = $(this).find("input[type=submit]").attr('reply-to');
      console.log(replyToId);
      if (emptyCheck != "" && emptyCheck != null){
        $.ajax({
          url: $that.attr('action'), // путь к обработчику берем из атрибута action
          type: $that.attr('method'), // метод передачи - берем из атрибута method
          data: {
              form_data: fData, 
              article_id: articleId,
              public_user_name: publicUserName,
              user_logged: userLogged,
              //saved_comment: savedComment,
              reply_to_id: replyToId
              
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

    
/* Визуализация "ответить" */ 
    $(document).on('click', '.reply', function(){

        if ( $(this).parent().find('form').hasClass('form-hidden') == 1 ) {

            $(this).parent().find('form').removeClass('form-hidden');
        }
        else {
            $(this).parent().find('form').addClass('form-hidden');
        }



    });   
    
/* Ограничение количества символов в сообщении */
    
    $(document).on('change', '.form-controll', function(e){
        console.log('input change');
       
        
        
        
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});