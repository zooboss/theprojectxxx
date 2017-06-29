<?php
if (!empty($_POST["txtemail"])) {
  header("Location: ".$_SERVER["REQUEST_URI"]);
  } //для безопасности: предотвращает вход в систему через кнопку "назад" в сочетании с F5
session_start();
require_once("/models/registration.php"); 
$user_login = new USER();
 
if(isset($_POST['btn-login'])) // отправка формы на вход
{   
	$uname = trim($_POST['uname']);
	$upass = trim($_POST['txtupass']);
	$user_login->login($uname,$upass,$remember);
}// отправка формы на вход

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
    //Вывод страницы статьи при получении её id по ссылке с главной страницы
    
    if (isset($_GET['id'])){
        $article = articles_get($link, $_GET['id']);
        include(dirname(__FILE__) . "/views/article_page.php");
    }
    
    //В противном случае вывод главной страницы
    
    else
    {
    include(dirname(__FILE__) . "/views/main_page.php");
    }

}

?>
  
