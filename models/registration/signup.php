<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/theprojectxxx/models/registration.php';


$reg_user = new USER();


if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	
	if (isset($_POST['gender']))
	{
	$gender = trim($_POST['gender']);
	}
	else 
	{
	$gender = 'Не указан';
	}
	
	if (isset($_POST['birthdate']))
	{
	$birth_date = ($_POST['birthdate']);
	}
	
	if (isset($_POST['name']))
	{
	$name = ($_POST['name']);
	}
	else 
	{
	$name = 'Не указано';
	}
	
	if (isset($_POST['surname']))
	{
	$surname = ($_POST['surname']);
	}
	else 
	{
	$surname = 'Не указана';
	} 
	
	if (isset($_POST['patronymic']))
	{
	$patronymic = ($_POST['patronymic']);
	}
	else 
	{
	$patronymic = 'Не указано' ;
	}
	
	 
	
		//* начало условия, если отправлен номер*// 
	if (isset($_POST['phone_number']))
	{
	$phone_number = ($_POST['phone_number']);
	
	require_once ('phone_definder.php');
function phone($phone = '', $convert = true, $trim = true)
{
    global $phoneCodes; // только для примера! При реализации избавиться от глобальной переменной.
    if (empty($phone)) {
        return '';
    }
    // очистка от лишнего мусора с сохранением информации о "плюсе" в начале номера
    $phone=trim($phone);
    $plus = ($phone[0] == '+');
    $phone = preg_replace("/[^0-9A-Za-z]/", "", $phone);
    $OriginalPhone = $phone;
    // конвертируем буквенный номер в цифровой
    if ($convert == true && !is_numeric($phone)) {
        $replace = array('2'=>array('a','b','c'),
        '3'=>array('d','e','f'),
        '4'=>array('g','h','i'),
        '5'=>array('j','k','l'),
        '6'=>array('m','n','o'),
        '7'=>array('p','q','r','s'),
        '8'=>array('t','u','v'),
        '9'=>array('w','x','y','z'));
        foreach($replace as $digit=>$letters) {
            $phone = str_ireplace($letters, $digit, $phone);
        }
    }
    // заменяем 00 в начале номера на +
    if (substr($phone, 0, 2)=="00")
    {
        $phone = substr($phone, 2, strlen($phone)-2);
        $plus=true;
    }
    // если телефон длиннее 7 символов, начинаем поиск страны
    if (strlen($phone)>7)
    foreach ($phoneCodes as $countryCode=>$data)
    {
        $codeLen = strlen($countryCode);
        if (substr($phone, 0, $codeLen)==$countryCode)
        {
            // как только страна обнаружена, урезаем телефон до уровня кода города
            $phone = substr($phone, $codeLen, strlen($phone)-$codeLen);
            $zero=false;
            // проверяем на наличие нулей в коде города
            if ($data['zeroHack'] && $phone[0]=='0')
            {
                $zero=true;
                $phone = substr($phone, 1, strlen($phone)-1);
            }
            $cityCode=NULL;
            // сначала сравниваем с городами-исключениями
            if ($data['exceptions_max']!=0)
            for ($cityCodeLen=$data['exceptions_max']; $cityCodeLen>=$data['exceptions_min']; $cityCodeLen--)
            if (in_array(intval(substr($phone, 0, $cityCodeLen)), $data['exceptions']))
            {
                $cityCode = ($zero ? "0" : "").substr($phone, 0, $cityCodeLen);
                $phone = substr($phone, $cityCodeLen, strlen($phone)-$cityCodeLen);
                break;
            }
            // в случае неудачи с исключениями вырезаем код города в соответствии с длиной по умолчанию
            if (is_null($cityCode))
            {
                $cityCode = substr($phone, 0, $data['cityCodeLength']);
                $phone = substr($phone, $data['cityCodeLength'], strlen($phone)-$data['cityCodeLength']);
            }
            // возвращаем результат
            return ($plus ? "+" : "").$countryCode.'('.$cityCode.')'.phoneBlocks($phone);
        }
    }
    // возвращаем результат без кода страны и города
    return ($plus ? "+" : "").phoneBlocks($phone);
}
// функция превращает любое числов в строку формата XX-XX-... или XXX-XX-XX-... в зависимости от четности кол-ва цифр
function phoneBlocks($number){
    $add='';
    if (strlen($number)%2)
    {
        $add = $number[0];
        $number = substr($number, 1, strlen($number)-1);
    }
    return $add.implode("-", str_split($number, 2));
}
// 


$phone_send = phone($phone_number); 
	}
elseif (!isset($_POST['phone_number'])) 
{
$phone_send = 'Не указан';
} 
	
	//* конец условия, если отправлен номер*// 
	
	$code = md5(uniqid(rand()));
	$stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code,$gender,$birth_date,$phone_send,$name,$surname,$patronymic))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to Coding Cage!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://localhost/x/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email $birth_date $gender $phone_send .
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
<title>Signup | Coding Cage</title>

<link rel="stylesheet" href="/theprojectxxx/libs/css/pickmeup.css" type="text/css" />	
<script type="text/javascript" src="/theprojectxxx/libs/js/pickmeup.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
.inputRed{
border:1px solid #ff4040;
background: #ffcece;
}
.inputGreen{
border:1px solid #83c954;
background: #e8ffce;
}

</style>
  </head>
 


<script type="text/javascript">

var login,
	email,
	password,
	password2,
	loginStat,
	emailStat,
	passwordStat,
	password2Stat;

$(function() {
	//Логин
	$("#login").change(function(){
		login = $("#login").val();
		var expLogin = /^[а-яА-ЯёЁa-zA-Z0-9]+$/g;
		var resLogin = login.search(expLogin);
		if(resLogin == -1){
			$("#login").next().hide().text("Неверный логин").css("color","red").fadeIn(400);
			$("#login").removeClass().addClass("inputRed");
			loginStat = 0;
			buttonOnAndOff();
		}else{
			$.ajax({
			url: "testLoginEmail.php",
			type: "GET",
			data: "login=" + login,
			cache: false,
			success: function(response){
				if(response == "no"){
					$("#login").next().hide().text("Логин занят").css("color","red").fadeIn(400);
					$("#login").removeClass().addClass("inputRed");					
				}else{					
					$("#login").removeClass().addClass("inputGreen");
					$("#login").next().text("");
				}			
				
			}
		});
			loginStat = 1;
			buttonOnAndOff();
		}
		
	});
	$("#login").keyup(function(){
		$("#login").removeClass();
		$("#login").next().text("");
	});
	
	// Email
	$("#email").change(function(){
		email = $("#email").val();
		var expEmail = /[-0-9a-z_]+@[-0-9a-z_]+\.[a-z]{2,6}/i;
		var resEmail = email.search(expEmail);
		if(resEmail == -1){
			$("#email").next().hide().text("Неверный формат Email").css("color","red").fadeIn(400);
			$("#email").removeClass().addClass("inputRed");
			emailStat = 0;
			buttonOnAndOff();
		}else{
			
			$.ajax({
			url: "testLoginEmail.php",
			type: "GET",
			data: "email=" + email,
			cache: false,			
			success: function(response){
				if(response == "no"){
					$("#email").next().hide().text("Email Занят").css("color","red").fadeIn(400);
					$("#email").removeClass().addClass("inputRed");					
				}else{					
					$("#email").removeClass().addClass("inputGreen");
					$("#email").next().text("");
				}					
			}
		});
			emailStat = 1;
			buttonOnAndOff();
		}
		
	});	
	$("#email").keyup(function(){
		$("#email").removeClass();
		$("#email").next().text("");
	});	
	
	
	//Пароль
	$("#password").change(function(){
		password = $("#password").val();
		if(password.length < 6){
			$("#password").next().hide().text("Слишком короткий пароль").css("color","red").fadeIn(400);
			$("#password").removeClass().addClass("inputRed");
			passwordStat = 0;
			buttonOnAndOff();
		}else{
			$("#password").removeClass().addClass("inputGreen");
			$("#password").next().text("");
			passwordStat = 1;
			buttonOnAndOff();
		}		
	});
	$("#password").keyup(function(){
		$("#password").removeClass();
		$("#password").next().text("");
	});
	
	//Проверка пароля
	$("#password2").change(function(){
		if(password2 != password){
			$("#password2").next().hide().text("Пароли не совпадают").css("color","red").fadeIn(400);
			$("#password2").removeClass().addClass("inputRed");
			password2Stat = 0;
			buttonOnAndOff();
		}else{
			$("#password2").removeClass().addClass("inputGreen");
			$("#password2").next().text("");
		}		
	});
	$("#password2").keyup(function(){
		password2 = $("#password2").val();
		if(password2 == password){
			password2Stat = 1;
			buttonOnAndOff();
		}else{
			password2Stat = 0;
			buttonOnAndOff();
		}
	});
	
	function buttonOnAndOff(){
		if(emailStat == 1 && passwordStat == 1 && password2Stat == 1 && loginStat == 1){
			$("#submit").removeAttr("disabled");
		}else{
			$("#submit").attr("disabled","disabled");
		}
	
	}
	
});
</script>

  <body >
	<?php if(isset($msg)) echo $msg;?>

      <form  method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
		<label><font color='red'>*</font> Ваш Логин:<br></label>
        <input type="text" class="input-block-level" id='login' placeholder="Логин" name="txtuname" required /> <span></span> <br> 
		
		<label><font color='red'>*</font> Ваш E-mail:<br></label>
        <input type="email" class="input-block-level" id='email' placeholder="Адрес электронной почты" name="txtemail" required /> <span></span> <br>
        
		<label><font color='red'>*</font> Ваш пароль:<br></label>
		<input type="password" class="input-block-level" id='password' placeholder="Пароль" name="txtpass" required /> <span></span> <br>
		
		<label><font color='red'>*</font> Подтвердите пароль:<br></label>
		<input type="password" class="input-block-level" id='password2' placeholder="Проверка пароля" name="txtpass_check" required /> <span></span>  <br>
	    
		<input type="radio" name="gender" value="Мужской"/>мужской
        <input type="radio" name="gender" value="Женский"/> женский <br>
  	Дата рождения(гггг.мм.дд): <input type="datetime" name='birthdate' id='date' value='' /> 
		Номер телефона (полный с кодом страны)<input type="phone" name='phone_number'  value='' /> <br>
		<input type="text" class="input-block-level" placeholder="Фамилия" name="name" /> <br>
		<input type="text" class="input-block-level" placeholder="Имя" name="surname"  /> <br>
		<input type="text" class="input-block-level" placeholder="Отчество" name="patronymic"  /> 
  		
  
  
  <!-- и т.д. -->
</datalist>
     	<hr />
       <input type="submit" name="submit" value="Зарегистрироваться" id="submit" disabled>
        <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
      </form>
	  
<script type='text/javascript'>
addEventListener('DOMContentLoaded', function () {
	pickmeup('#date', {
		position       : 'right',
		hide_on_select : true
	});
});
</script>


<!--Проверка пароля, логина и всего остального -->

	  


	

  </body>
</html>