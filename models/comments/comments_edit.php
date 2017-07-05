<?php 
if(isset($_POST['btn-comment']))
{
	$content = $_POST['comment'];  //комментарий
	$prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip отправителя 
	$ip = ip2long($prepare_ip);
	$comment_date = date("Y.m.d.");  //дата
	$comment_time = date("H:i:s");   //время
	$article = $_GET['id'];
	$commentator = $row['userName'];
    $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip); //функция класса COMMENTS в comments.php
	header("Location: http://localhost/theprojectxxx/index.php?id=$article");
}
	


?>