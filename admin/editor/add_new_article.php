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
public function add_article($recieved_date,$article_date,$article_time,$ip_1,$title,$keywords)
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
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		

	}
	
}



}	//конец если проверка на безопасность пройдена
	
?>	