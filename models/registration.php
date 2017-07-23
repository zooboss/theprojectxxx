<?php

//require_once 'dbconfig.php';
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php");

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID() 
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	

     //! удалить комментарий!
	//$uname - Логин для входа ,$ulogin - Логин для чата (общий) ,$email - почта ,$upass - пароль ,$code - код активации ,$ip_1 - айпиадрес при регистрации ,$gender - пол ,$birth_date - дата рождения ,$phone_send - номер телефона
	//,$name  реальное имя,$surname - фамилия ,$patronymic - общество 
	//Регистрация
	public function register($uname,$ulogin,$email,$upass,$code,$ip_1,$gender,$birth_date,$phone_send,$name,$surname,$patronymic)
	{
		try
		{		// генерация пароля для Соли
		
		 function GenSalt ($length=10) {
     $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
     $length = intval($length);
     $size=strlen($chars)-1;
     $Salt = "";
     while($length--) $Salt.=$chars[rand(0,$size)];
     return $Salt;
}

$salt_encrypt = GenSalt(); //генерация соли
		    

			$salt = hash("sha256", $salt_encrypt );
			$password = hash("sha256",(hash("sha256", $upass).$salt));
			$registration_date = date("Y.m.d.H.i.s");
			
			$stmt = $this->conn->prepare("INSERT INTO users(userName,PublicUserName,userEmail,userPass,tokenCode,ip1,datereg,sex,birthday,phone,Name,Surname,Patronymic,salt) 
			                                           VALUES(:user_name,:user_name_public, :user_mail, :user_pass, :active_code, :ip_1,:reg_date,:user_sex, :birth, :phone_number, :real_name, :real_surname, :real_patronymic, :real_salt)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_name_public",$ulogin);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->bindparam(":reg_date",$registration_date);
			$stmt->bindparam(":ip_1",$ip_1);
			$stmt->bindparam(":user_sex",$gender);
			$stmt->bindparam(":birth",$birth_date);
			$stmt->bindparam(":phone_number",$phone_send);
			$stmt->bindparam(":real_name",$name);
			$stmt->bindparam(":real_surname",$surname);
			$stmt->bindparam(":real_patronymic",$patronymic);
			$stmt->bindparam(":real_salt",$salt);
			
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		

	}
	
	// Вход в систему 
	public function login($uname,$upass,$remember)
	{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userName=:userName_id");
			$stmt->execute(array(":userName_id"=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{ 
				if($userRow['userStatus']=="Y")
				{
	
					if($userRow['userPass']==hash("sha256", hash("sha256",$upass).$userRow['salt']))
			
					{
					
					if ( !empty($remember) and $remember == 1 ) //если нажата кнопка "запомнить"
						{
										
	function GenCookie ($length=24) 
	{
     $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
     $length = intval($length);
     $size=strlen($chars)-1;
     $Cookie = "";
     while($length--) $Cookie.=$chars[rand(0,$size)];
     return $Cookie;
	}
//Сформируем случайную строку для куки (используем функцию GenCookie):
	$key = GenCookie(); 

//Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
	setcookie('username', $uname, time()+60*60*24*30, '/'); //почта
	setcookie('key', $key, time()+60*60*24*30,  '/' ); //кука
								
		$sql = "UPDATE users SET cookie = :user_cookie
				WHERE userName= :user_name";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_name', $uname); 
	    $stmt->bindParam(':user_cookie', $key);       
		$stmt->execute();	

		$_SESSION['userSession'] = $userRow['userID'];
		return true;
		}
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
						header("Location: index.php?1212312");
						
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
	

	
	
	public function Cookie_login($uname,$key)
	{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userName=:user_name");
			$stmt->execute(array("user_name"=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{ 
				if($userRow['userStatus']=="Y")
				{
	
					if($userRow['cookie']==$key)
			
					{
							
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
						
					}
					
				}
				
			}
				
	
	}
	// Проверка авторизации
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	//Перенаправление
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	// Выход из системы
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	// Отправка почты
		
	function send_mail($email,$message,$subject)
	{						
		require_once('registration/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.timeweb.ru.";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="system@zmagar.ru";  
		$mail->Password="a193782465b*";            
		$mail->SetFrom('system@zmagar.ru','>Ювелирный магазин "Кот"');
		$mail->AddReplyTo("system@zmagar.ru",'Ювелирный магазин "Кот"');
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
}