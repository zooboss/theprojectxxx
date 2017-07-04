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

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 

$article_comments = new COMMENTS();	


if($article_comments->check_comments()== true)  // проверяем есть ли коментарии при помощи функции в comments.php
{
$stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");
$stmt->execute([$_GET['id']]);
?>
<h1>Комментарии</h1>  
<?php    
foreach ($stmt as $row)
{
//выводим комменты
?>

<p>Автор:<?php echo $row['author']; ?> </p>
<p>Комментарий:<?php echo $row['content']; ?> </p> 
<p>Дата:<?php echo $row['date']; ?> </p> 
<p>Дата:<?php echo $row['time']; ?> </p> 


<?php
}
}
else  //если комментов нет 
{
?>  
<h2>Комментариев еще нет!</h2>
<button>Стать першим на хохлосраче</button>
<?php 
}?> 
</body>
</html>