<?php 

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 
$article_comments = new COMMENTS();		

if(isset($_POST['form_data'])){
  $req = false; // изначально переменная для "ответа" - false
  parse_str($_POST['form_data'], $form_data); // разбираем строку запроса
  // Приведём полученную информацию в удобочитаемый вид
  ob_start(); 
?>
 <h1>Вскукарек добавлен!</h1> 
<?php  
  $commentator = $form_data['author']; //автор
  $content = $form_data['comment'];  //комментарий
  $article = $form_data['article'];  //id статьи
  $comment_date = date("Y.m.d.");  //дата
  $comment_time = date("H:i:s");   //время
  $prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip отправителя 
  $ip = ip2long($prepare_ip);
  
  $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip); //функция класса COMMENTS в comments.php 

  $req = ob_get_contents();
  ob_end_clean();
  echo json_encode($req); // вернем полученное в ответе
  exit;

}



if (isset($_POST['commentator']))  //если получаем имя зарегестрированного пользователя, то выдаем форму для комментария
{
echo "Комментатор ". $commentator_post = $_POST['commentator']."<br>";
echo "Номер статьи ". $article_post= $_POST['article_id'];

?>

  
  

<form id="my_form" method="POST" action="models/comments/comments_edit.php" > 
<textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10"></textarea>
<input type="hidden" class="" name="article" value="<?php echo $article_post ?>" ></input>
<input type="hidden" class="" name="author" value="<?php echo $commentator_post; ?>" ></input>
<input type="submit" class="" name="btn-comment" value="Отправить"  ></input>
</form>
<div class="close_window">x</div>

<script >
$(function(){
  $('#my_form').on('submit', function(e){
    e.preventDefault();
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
        $('#my_form').replaceWith(json); // заменим форму данными, полученными в ответе.
        }
      }
    });
  });
});

</script>


<?php 
}
?>

 
