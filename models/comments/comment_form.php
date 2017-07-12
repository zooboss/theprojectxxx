<form id="my_form" method="POST" action="models/comments/comments_edit.php" > 
<textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
<input type="hidden" class="" name="article" value="<?php echo $_GET['id']; ?>" ></input>
<input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
<input type="submit" class="" name="btn-comment" value="Отправить"  ></input>
</form>

<a id="showform" href = "#0">Добавить еще один комментарий</a>



<script >

$(function(){
  $('#my_form').on('submit', function(e){
    e.preventDefault();
	
	var textarea = $("textarea[name='comment']");
    var $that = $(this),
        fData = $that.serialize(); // сериализируем данные
        // ИЛИ
        // fData = $that.serializeArray();
    $.ajax({
      url: $that.attr('action'), // путь к обработчику берем из атрибута action
      type: $that.attr('method'), // метод передачи - берем из атрибута method
      data: {form_data: fData},
      dataType: 'json',
      success: function(json){
        // В случае успешного завершения запроса...
        if(json){
        $('#comments').replaceWith(json); // заменим форму данными, полученными в ответе
		$('#my_form').toggle();
		textarea.val('');
        $('#showform').show();
        }
      }
    });
  });
});

</script>

<script >
$(function(){
  $('#showform').on('click', function(showForm){
    showForm.preventDefault();
		$('#my_form').toggle();
		$('#showform').hide();
		$('#comment_info').remove();
		$('#comments').replaceWith(json);
		
		
  });
  
});

</script>