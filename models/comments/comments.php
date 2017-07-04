<?php 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 

class COMMENTS {	

    
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

// ѕроверка авторизации
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

// выход из системы
public function logout()
{
		session_destroy();
		$_SESSION['userSession'] = false;
}
	

public function check_comments()
	{

$article_id = $_GET['id'];	


$sql = "SELECT COUNT(*) FROM comments WHERE article_id = ?";
$result=$this->conn->prepare($sql);
$result->execute(array($article_id));
return $result->fetchColumn() ;



		
								


} 

}//class
?>