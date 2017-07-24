<?php 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
$article_comments = new COMMENTS();		
 if(isset($_POST['form_data'])){
  $req = false; // изначально переменная для "ответа" - false
  parse_str($_POST['form_data'], $form_data); // разбираем строку запроса
  $form_reply = $_POST['form_reply'];
  $form_reply_number = $_POST['form_reply_number'];
  
     
  
  // Приведём полученную информацию в удобочитаемый вид
  ob_start(); 
  
  $commentator = $form_data['author']; //автор
  $content = $form_data['comment'];  //комментарий
  
  if (empty($content)) //если поле комментария пустое
  {
?>
<div id="comments" >
    <h2>Нельзя отправить пустой комментарий!</h2>
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
<!--
<div id="comment_info">
 <h1>Ваш комментарий добавлен!</h1> 
</div>
-->


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
<div id="comments" class = "col-md-9 col-sm-12 col-xs-12">

<form id="my_form" class = "add-comment-form" method="POST" action="models/comments/comments_edit.php" > 
    <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
    <input type="hidden" class="" name="article" value="<?php echo $_GET['id']; ?>" ></input>
    <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
    <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
</form>
<a id="showform" href = "#0">Добавить еще один комментарий</a>  <!--выдаем форму -->

<?php
  $comment_number = 4;
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
                       <a href = "#0" class = "reply">Ответить</a>
                       <form id="my_form" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                            <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
                            <input type="hidden" class="" name="article" value="<?php echo $_GET['id']; ?>" ></input>
                            <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
                            <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
                        </form>
                   </div>                
                </div>
                <?php 
                if ($comment_number == $form_reply_number) {
                ?>
                    <div class = "single-comment reply-1">
                       <div class = "single-comment-avatar">
                           <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "single-comment-avatar-image">
                       </div>
                       <div class = "single-comment-body">
                           <div class = "single-comment-header">
                               <a href = "#0"><?php echo $com['author']?></a>
                               <span><?php echo $com['date'] . " " . $com['time'] ?></span>
                           </div>
                           <div class = "single-comment-text">
                              <span><?php echo $com['content'] . " " . $comment_number . $form_reply_number ; ?></span>  
                           </div>
                           <div class = "single-comment-footer">
                               <a href = "#0" class = "reply">Ответить</a>
                               <form id="my_form" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                                    <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
                                    <input type="hidden" class="" name="article" value="<?php echo $_GET['id']; ?>" ></input>
                                    <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
                                    <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
                                </form>
                           </div>                
                        </div>
                    </div>    
                <?php
                }
                ?>
                
            </div>
           <?php
            $comment_number++;
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
