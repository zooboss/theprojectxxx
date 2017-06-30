<?php
session_start();
//require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('index.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	$stmt = $user->runQuery("SELECT userID FROM users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Здравствуйте, $email
				   <br /><br />
				   Мы получили запрос на сброс пароля для вашей учетной записи
				   Если Вы отправляли запрос на восстановление пароля, перейдите по ссылке, если нет - просто проигнорируйте письмо.                  
				   <br /><br />
				   Перейдите по ссылке для сброса пароля
				   <br /><br />
				   <a href='http://localhost/models/registration/resetpass.php?id=$id&code=$code'>перейдите по ссылке для сброса пароля</a>
				   <br /><br />
				   Спасибо :)
				   ";
		$subject = "Восстановление пароля";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Мы отправили письмо с инструкциями на $email.
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Извините!</strong>  пользователь не найден
			    </div>";
	}
}
?>

