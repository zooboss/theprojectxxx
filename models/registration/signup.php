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


  </head>
 




  <body >
	<?php if(isset($msg)) echo $msg;?>
    <div class="container">
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        <input type="text" class="input-block-level" placeholder="Логин" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="Адрес электронной почты" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Пароль" name="txtpass" required />
	    <input type="radio" name="gender" value="Мужской"/>мужской
        <input type="radio" name="gender" value="Женский"/> женский
  	Дата рождения(гггг.мм.дд): <input type="datetime" name='birthdate' id='date' value='' />
		Номер телефона (полный с кодом страны)<input type="phone" name='phone_number'  value='' />
		<input type="text" class="input-block-level" placeholder="Фамилия" name="name" />
		<input type="text" class="input-block-level" placeholder="Имя" name="surname"  />
		<input type="text" class="input-block-level" placeholder="Отчество" name="patronymic"  />
  		
  
  
  <!-- и т.д. -->
</datalist>
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
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
	  

    </div> <!-- /container -->
	
<?php

?> 
  </body>
</html>