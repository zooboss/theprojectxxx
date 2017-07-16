<?php 
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
            <div class = "single-comment">
               <div class = "single-comment-avatar">
                   <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "single-comment-avatar-image">
               </div>
               <div class = "single-comment-body">
                   <div class = "single-comment-header">
                       <a href = "#0"><?php echo $com['author']?></a>
                       <span><?php echo $com['date'] . " " . $com['time'] ?></span>
                   </div>
                   <div class = "single-comment-text">
                      <span><?php echo $com['content']; ?></span>  
                   </div>
                   <div class = "single-comment-footer">
                       <a href = "#0">Ответить</a>
                   </div>                
                </div>
                
            </div>
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
