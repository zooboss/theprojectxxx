<?php
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 

$article_comments = new COMMENTS();		
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments_edit.php"); 

 ?>
<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
</head>
<body>
   <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>
   
    <div class = "article col-md-12">
        <h3> <?=$article['title']?></h3>
                <em> Published: <?=$article['date']?></em>
                <p><?=$article['content']?></p>
    </div>
    

    <p><a name="comments"></a></p>
  

<?php   




if($article_comments->check_comments()== true)  // проверяем есть ли коментарии при помощи функции в comments.php
{
$stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");
$stmt->execute([$_GET['id']]);
?>
<h1>Комментарии</h1>  
<?php    
foreach ($stmt as $com)
{
//выводим комменты
?>
<h2>Срач здесь</h2>
<p>Автор:<?php echo $com['author']; ?> </p>
<p>Комментарий:<?php echo $com['content']; ?> </p> 
<p>Дата:<?php echo $com['date']; ?> </p> 
<p>Время:<?php echo $com['time']; ?> </p> 

<?php
}
if($user_login->is_logged_in()) {  //Если авторизован
?>
<form method="post"> 
 <div class="form-group">
 <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10"></textarea>
 <div class="widget-content padded">
<input type="submit" class="" name="btn-comment" value="Стать першим на хохлосраче" id="" ></input>
</div>
</div>
</form>
<?php
}  // конец Если авторизован 

} //Конец условия, если есть комментарий 
  
else  //если комментов нет 
{
?>  

<h2>Комментариев еще нет!</h2>
<h2>Авторизуйся и устрой набег!</h2>

<?php if($user_login->is_logged_in()) {  //Если авторизован ?>
<form method="post"> 
 <div class="form-group">
 <textarea placeholder="Ваш комментарий" name="comment" class="form-control smoll" rows="5" cols="10"></textarea>
 <div class="widget-content padded">
<input type="submit" class="" name="btn-comment" value="Стать першим на хохлосраче" id="" ></input>
</div>
</div>
</form>

<?php 
}  //конец Если авторизован 
}  // конец else если комментариев нет


?> 
</body>
</html>