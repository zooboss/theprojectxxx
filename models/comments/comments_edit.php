<?php 


//require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");


if (isset($_POST['article_id'])){
    $article_comments = new COMMENTS();
    //var_dump($article_comments);
    ob_start();
    $article_id = $_POST['article_id'];
    $user_logged = $_POST['user_logged'];
    $public_user_name = $_POST['public_user_name'];
    $saved_comment = trim($_POST['saved_comment']);
}
//Новый комментарий

 if(isset($_POST['form_data'])){
  $req = false; // изначально переменная для "ответа" - false
  parse_str($_POST['form_data'], $form_data); // разбираем строку запроса
      
  // Приведём полученную информацию в удобочитаемый вид
       
        //Записываем новый комментарий в бд  
      $reply_to_id = $_POST['reply_to_id'];
      $commentator = $form_data['author']; //автор
      $content = $form_data['comment'];  //комментарий
      $article = $article_id;  //id статьи
      $comment_date = date("Y.m.d.");  //дата
      $comment_time = date("H:i:s");   //время
      $prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip отправителя 
      $ip = ip2long($prepare_ip);
      $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip, $reply_to_id); //функция класса COMMENTS в comments.php 
        
/* если поле комментария пустое  - теперь проверка в js
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
  */
}

    //Выводим форму и список комментариев в любом случае без условий -->
    //Запрашиваем бд$article_comments = new COMMENTS();
    $stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");   
    $stmt->execute([$article_id]);
    $stmt = $stmt->fetchAll();
    
    
?>



<div id="comments" class = "col-md-9 col-sm-12 col-xs-12"
             index = "<?php echo $article_id ?>" 
             user_logged = "<?php echo $user_logged ?>" 
             public_user_name = "<?php echo $public_user_name  ?>"
      
>
    <p><a name="comments"></a></p>
    <h4 class = "comments-title">
        Комментарии 
        (48)
        <a href = "#0">[i]</a>

    </h4>
<?php
   
//Реакции на залогиненного и незалогиненного пользователей   
if($user_logged == true) {
    $form_id = "my_form";
    $data_toggle = "none";
    $data_target = "none";
}
else {
    $form_id = "unlogged_form";
    $data_toggle = "modal";
    $data_target = "#login-window";
    
}
?>
    <form id="<?php echo $form_id ?>" class = "add-comment-form" method="POST" action="models/comments/comments_edit.php" > 
        <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ><?php if ($saved_comment != '') echo $saved_comment ?></textarea>
        <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
        <input type="hidden" class="" name="author" value="<?php echo $public_user_name; ?>" ></input>
        <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  
                data-toggle = "<?php echo $data_toggle ?>"
                data-target = "<?php echo $data_target ?>"
                reply-to    = "0"   
        >
            
        </input>
    </form>

<?php


?>


<?php

//Есть комментарии
if($article_comments->check_comments()== true){

  foreach ($stmt as $com)
        {
            if ($com['reply_to_id'] == 0){
            ?>
            
            <div class = "single-comment" comment-id = "<?php echo $com['id'] ?>" >
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
                       <form id="<?php echo $form_id ?>" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                            <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ><?php if ($saved_comment != '') echo $saved_comment ?></textarea>
                            <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
                            <input type="hidden" class="" name="author" value="<?php echo $public_user_name; ?>" ></input>
                            <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  
                                    data-toggle = "<?php echo $data_toggle ?>"
                                    data-target = "<?php echo $data_target ?>"
                                    reply-to    = "<?php echo $com['id']   ?>"
                            >

                            </input>
                        </form>
                   </div>                
                </div>
                <?php 
                   foreach ($stmt as $com1) {
                        if ($com1['reply_to_id'] == $com['id']) {
                    
                ?>
                            <div class = "single-comment reply-comment" comment-id = "<?php echo $com1['id'] ?>" >
                               <div class = "single-comment-avatar">
                                   <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "single-comment-avatar-image">
                               </div>
                               <div class = "single-comment-body">
                                   <div class = "single-comment-header">
                                       <a href = "#0"><?php echo $com1['author']?></a>
                                       <span><?php echo $com1['date'] . " " . $com1['time'] ?></span>
                                   </div>
                                   <div class = "single-comment-text">
                                      <span><?php echo $com1['content'] ?></span>  
                                   </div>
                                   <div class = "single-comment-footer">
                                       <a href = "#0" class = "reply">Ответить</a>
                                       <form id="<?php echo $form_id ?>" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                                            <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ><?php if ($saved_comment != '') echo $saved_comment ?></textarea>
                                            <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
                                            <input type="hidden" class="" name="author" value="<?php echo $public_user_name; ?>" ></input>
                                            <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  
                                                    data-toggle = "<?php echo $data_toggle ?>"
                                                    data-target = "<?php echo $data_target ?>"
                                                    reply-to    = "<?php echo $com1['id']   ?>"    
                                            >

                                            </input>
                                        </form>
                                   </div>                
                                 </div>
                                 
                                 <?php 
                                   foreach ($stmt as $com2) {
                                        if ($com2['reply_to_id'] == $com1['id']) {

                                ?>
                                            <div class = "single-comment reply-comment" comment-id = "<?php echo $com2['id'] ?>" >
                                               <div class = "single-comment-avatar">
                                                   <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "single-comment-avatar-image">
                                               </div>
                                               <div class = "single-comment-body">
                                                   <div class = "single-comment-header">
                                                       <a href = "#0"><?php echo $com2['author']?></a>
                                                       <span><?php echo $com2['date'] . " " . $com2['time'] ?></span>
                                                   </div>
                                                   <div class = "single-comment-text">
                                                      <span><?php echo $com2['content'] ?></span>  
                                                   </div>
                                                   <div class = "single-comment-footer">
                                                       <a href = "#0" class = "reply">Ответить</a>
                                                       <form id="<?php echo $form_id ?>" class = "add-comment-form form-hidden" method="POST" action="models/comments/comments_edit.php" > 
                                                            <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10" ><?php if ($saved_comment != '') echo $saved_comment ?></textarea>
                                                            <input type="hidden" class="" name="article" value="<?php echo $article_id; ?>" ></input>
                                                            <input type="hidden" class="" name="author" value="<?php echo $public_user_name; ?>" ></input>
                                                            <input type="submit" class="btn btn-primary pull-right" name="btn-comment" value="Отправить"  
                                                                    data-toggle = "<?php echo $data_toggle ?>"
                                                                    data-target = "<?php echo $data_target ?>"
                                                                    reply-to    = "<?php echo $com2['id']   ?>"    
                                                            >

                                                            </input>
                                                        </form>
                                                   </div>                
                                                 </div>
                                               </div>    
                                <?php
                                        }
                                    }
                                ?>
                                </div>    
                <?php
                        }
                    }
                ?>
                    
                
            </div>
           <?php
        }
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
