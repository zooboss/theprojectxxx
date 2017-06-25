<?php
require_once("/models/registration.php"); 
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('/index.php');
}
require_once( $_SERVER['DOCUMENT_ROOT'] ."/templates/head.php");

?>
<body>
<?php 




if(isset($_GET['id']) && isset($_GET['code']))
{
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];
 
 $statusY = "Y";
 $statusN = "N";
 
 $stmt = $user->runQuery("SELECT userID,userStatus FROM users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
 $stmt->execute(array(":uID"=>$id,":code"=>$code));
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if($stmt->rowCount() > 0)
 {
  if($row['userStatus']==$statusN)
  {
   $stmt = $user->runQuery("UPDATE users SET userStatus=:status WHERE userID=:uID");
   $stmt->bindparam(":status",$statusY);
   $stmt->bindparam(":uID",$id);
   $stmt->execute(); 
?>   
<div class='alert alert-success'>
<button class='close' data-dismiss='alert'>&times;</button>
<strong>Спасибо!</strong>  Ваша учетная запись подтверждена! <a href='index.php'>Войти</a>
</div>
<?php  }
  else
  {
?>
<div class='alert alert-error'>
<button class='close' data-dismiss='alert'>&times;</button>
<strong>Извините !</strong>  Ваша учетная запись уже была активирована <a href='index.php'>Войти</a>
</div>     
<?php   }
 }
 else
 {
 ?>
<div class='alert alert-error'>
<button class='close' data-dismiss='alert'>&times;</button>
<strong>Извините</strong>  Учетная запись не обнаружена, если Вы зарегестрировались, но не можете подтвердить учетную запись - свяжитесь со службой поддержки <a href='signup.php'>Signup here</a>
</div>
 <?php } 
}
require_once( $_SERVER['DOCUMENT_ROOT'] ."/templates/footer.html");
require_once( $_SERVER['DOCUMENT_ROOT'] ."/templates/scripts.php");
?>	
  
</body>
</html>