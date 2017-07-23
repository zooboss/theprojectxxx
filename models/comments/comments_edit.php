<?php 

session_start();
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");


if (isset($_POST['article_id'])){
    $article_comments = new COMMENTS();	
    ob_start();
    $article_id = $_POST['article_id'];
    $user_logged = $_POST['user_logged'];
    $public_user_name = $_POST['public_user_name'];
}
//Новый комментарий

 if(isset($_POST['form_data'])){
  $req = false; // изначально переменная для "ответа" - false
  parse_str($_POST['form_data'], $form_data); // разбираем строку запроса
      
  // Приведём полученную информацию в удобочитаемый вид
       
        //Записываем новый комментарий в бд     
      $commentator = $form_data['author']; //автор
      $content = $form_data['comment'];  //комментарий
      $article = $article_id;  //id статьи
      $comment_date = date("Y.m.d.");  //дата
      $comment_time = date("H:i:s");   //время
      $prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip отправителя 
      $ip = ip2long($prepare_ip);
      $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip); //функция класса COMMENTS в comments.php 
   
//если поле комментария пустое  
     if (empty($content)) {
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
  
}

    //Выводим форму и список комментариев в любом случае без условий -->
    //Запрашиваем бд
    $stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");   
    $stmt->execute([$article_id]);
?>



<div id="comments" class = "col-md-9 col-sm-12 col-xs-12">
    <p><a name="comments"></a></p>
    <h4 class = "comments-title">
        Комментарии 
        (48)
        <a href = "#0">[i]</a>

    </h4>
<?php
   
   
if($user_logged == true) {
?>
<form id="my_form" class = "add-comment-form" method="POST" action="models/comments/comments_edit.php" > 
    <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
    <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
    <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
    <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
</form>

<?php
}
?>


<?php

//Есть комментарии
if($article_comments->check_comments()== true){

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
                            <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
                            <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
                            <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
                        </form>
                   </div>                
                </div>
                <?php 
                
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
                              <span><?php echo "reply_placeholder"; ?></span>  
                           </div>
                           <div class = "single-comment-footer">
                               <a href = "#0" class = "reply">Ответить</a>
                               <form id="my_form" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                                    <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ></textarea>
                                    <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
                                    <input type="hidden" class="" name="author" value="<?php echo $row['PublicUserName'] ; ?>" ></input>
                                    <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  ></input>
                                </form>
                           </div>                
                        </div>
                    </div>    
                <?php
                
                ?>
                
            </div>
           <?php
            
    }
}

//Нет комментариев
    if($article_comments->check_comments()== false){
        ?>
        <div id="comments">	
            <h2>Комментариев еще нет!</h2>
        </div>
    <?php
    }
    ?>

</div>


<?php  $req = ob_get_contents();
  ob_end_clean();
  echo json_encode($req); // вернем полученное в ответе
  exit;

?>
