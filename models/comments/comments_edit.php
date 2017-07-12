﻿<?php 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
$article_comments = new COMMENTS();		
 if(isset($_POST['form_data'])){
  $req = false; // изначально переменная для "ответа" - false
  parse_str($_POST['form_data'], $form_data); // разбираем строку запроса
  // Приведём полученную информацию в удобочитаемый вид
  ob_start(); 
?>

<?php  
  $commentator = $form_data['author']; //автор
  $content = $form_data['comment'];  //комментарий
  if (empty($content)) //если поле комментария пустое
  {
?>
<div id="comments">
<h1>Нельзя отправить пустой комментарий!</h1>
</div>
<?php	  
 $req = ob_get_contents();
  ob_end_clean();
  echo json_encode($req); // вернем полученное в ответе
  exit;	  
  }
  else
  {
?>
<div id="comment_info">
 <h1>Ваш комментарий добавлен!</h1> 
</div> 
<?php 
  $article = $form_data['article'];  //id статьи
  $comment_date = date("Y.m.d.");  //дата
  $comment_time = date("H:i:s");   //время
  $prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip отправителя 
  $ip = ip2long($prepare_ip);
  $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip); //функция класса COMMENTS в comments.php 

  $stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");
  $stmt->execute([$form_data['article']]);
?>
<div id="comments">
<?php
  foreach ($stmt as $com)
        {
            ?>
            <p>Автор:<?php echo $com['author']; ?> </p>
            <p>Комментарий:<?php echo $com['content']; ?> </p> 
            <p>Дата:<?php echo $com['date']; ?> </p> 
            <p>Дата:<?php echo $com['time']; ?> </p> 
           <?php
        }
?>
</div>
<?php  $req = ob_get_contents();
  ob_end_clean();
  echo json_encode($req); // вернем полученное в ответе
  exit;

} //конец else

}  //конец если отправленна form_data

?>
