<?php
session_start();
require_once("/models/registration.php"); 
$user_login = new USER();


 
if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
}

$stmt = $user_login->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

require_once(dirname(__FILE__)."/models/database.php");
$link = db_connect();

require_once(dirname(__FILE__) . "/models/functions.php");
$articles = articles_all($link);

include(dirname(__FILE__) . "/views/main_page.php");

?>
  
