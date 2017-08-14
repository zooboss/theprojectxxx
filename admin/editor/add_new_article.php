<?php 
if (!defined("Redactor_check") or !isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session']) )
{
exit ("Пошел на хуй");	
}
else {  //Если проверка на безопасность пройдена

include_once ($_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/admin/admin_bd_config.php");	//База данных 


class ARTICLES {	

	private $conn; 

	public function __construct() 
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	

	
//Добавление новой статьи
public function add_article($recieved_date,$article_date,$article_time,$ip_1,$title,$keywords,$imgFile,$tmp_dir,$imgSize)
{



		

try
		{		
			$stmt = $this->conn->prepare("INSERT INTO articles(content,date,Time,IP,title,keywords) 
			             VALUES(:Content,:Date,:Time,:IP,:Title,:Keywords)");
			$stmt->bindparam(":Content",$recieved_date);
			$stmt->bindparam(":Date",$article_date);
			$stmt->bindparam(":Time",$article_time);
			$stmt->bindparam(":IP",$ip_1);
			$stmt->bindparam(":Title",$title);
			$stmt->bindparam(":Keywords",$keywords);

			$stmt->execute();	
			$last_ID = $this->conn->lastInsertId(); //получаем идентификатор последней статьи
		
	
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		
				$upload_dir = "C:/xampp/htdocs/theprojectxxx/img/articles/"; // куда зугружаем картинку
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // получаем формат картинки
		
			// проверяем расширения
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // разрешенные типы файлов
		
			//переименовываем картинку
		     $userpic = "article_image-".$last_ID.".".$imgExt;
				
			// 
			if(in_array($imgExt, $valid_extensions)){			
				// проверяем, чтобы не карттинка была не больше '5MB'
				if($imgSize < 5000000)				{
					  if (move_uploaded_file($tmp_dir,$upload_dir.$userpic))
					  {
					echo 'Главная картинка добавлена <br>';
					} 
					else {
					echo 'Главная картинка не добавлена <br>';
					}
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	

	}
	
}



}	//конец если проверка на безопасность пройдена
	
?>	