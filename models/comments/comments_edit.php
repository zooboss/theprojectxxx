<?php 
if(isset($_POST['btn-comment']))
{
	$content = $_POST['comment'];  //�����������
	$prepare_ip = ($_SERVER["REMOTE_ADDR"]); //ip ����������� 
	$ip = ip2long($prepare_ip);
	$comment_date = date("Y.m.d.");  //����
	$comment_time = date("H:i:s");   //�����
	$article = $_GET['id'];
	$commentator = $row['userName'];
    $article_comments->add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip); //������� ������ COMMENTS � comments.php
	header("Location: http://localhost/theprojectxxx/index.php?id=$article");
}
	


?>