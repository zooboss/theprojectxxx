<?php
if (!empty($_POST["txtemail"])) {
  header("Location: ".$_SERVER["REQUEST_URI"]);
  } //для безопасности: предотвращает вход в систему через кнопку "назад" в сочетании с F5
session_start();
require_once("/models/registration.php"); 
$user_login = new USER();

  $ip = $_SERVER["REMOTE_ADDR"];
 
if(isset($_POST['btn-login']))
{   
    $ip_sent = ($_POST[$ip]);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	$user_login->login($email,$upass);
}// отправка формы регистрации

if($user_login->is_logged_in()!="")
{
$stmt = $user_login->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}// если авторизован, то выбираем из базы через PDO, можно убрать условие, но будет вылезать ошибка.
require_once(dirname(__FILE__)."/models/database.php");
$link = db_connect();

require_once(dirname(__FILE__) . "/models/functions.php");
$articles = articles_all($link);



if (isset($_GET['userID'])) 
{
include(dirname(__FILE__) . "/views/user-profile.php");
}
else 
{
include(dirname(__FILE__) . "/views/main_page.php");
}
echo $_SERVER["REMOTE_ADDR"];
?>
  
