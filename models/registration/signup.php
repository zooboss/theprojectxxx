<?php

$reg_user = new USER();


if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('/theprojectxxx/index.php');   //Пути 
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$ulogin = trim($_POST['txtunamepublic']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$ip = $_SERVER["REMOTE_ADDR"];
	$ip_1 = ip2long($ip); //long2ip($ip_1) для вывода числа из БД;
	// для поиска по диапиазону SELECT .... WHERE ip BETWEEN INET_ATON('148.100.0.0') AND INET_ATON('158.255.255.255')

	
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
	
	require_once ( $_SERVER['DOCUMENT_ROOT'] .'/theprojectxxx/models/registration/phone_definder.php');
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
	

		if($reg_user->register($uname,$ulogin,$email,$upass,$code,$ip_1,$gender,$birth_date,$phone_send,$name,$surname,$patronymic))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Здравствуйте, $ulogin.
						<br /><br /> 
						Добро пожаловать!<br/>
						Для подтверждения регистрации перейдите по ссылке<br/>
						<br /><br />
						<a href='http://localhost/x/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>  
						<br /><br />
						Спасибо,";
						
			$subject = "Подтверждение регистрации";  //тема письма //поменять адрес ссылки
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "12321321321321321321";
			//header("Location: http://localhost/theprojectxxx/views/signup_page.php?email=$email");
            header("Location: http://localhost/theprojectxxx/index.php?send=registration&?email=$email");
							
		}
		else
		{
			echo "Что-то пошло не так";
		}		
	}

?>