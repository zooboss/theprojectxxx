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

	

public function check_comments()
	{

$article_id = $_POST['article_id'];	


$sql = "SELECT COUNT(*) FROM comments WHERE article_id = ?";
$result=$this->conn->prepare($sql);
$result->execute(array($article_id));
return $result->fetchColumn() ;
} 


public function add_comment($commentator,$content,$article,$comment_date,$comment_time,$ip, $reply_to_id)
{

try
		{		
			$stmt = $this->conn->prepare("INSERT INTO comments(author,content,article_id,date,time,author_ip,reply_to_id) 
			             VALUES(:Author_id,:Comment,:Article_id,:Comment_date,:Comment_time,:Author_ip, :Reply_to_id)");
			$stmt->bindparam(":Author_id",$commentator);
			$stmt->bindparam(":Comment",$content);
			$stmt->bindparam(":Article_id",$article);
			$stmt->bindparam(":Comment_date",$comment_date);
			$stmt->bindparam(":Comment_time",$comment_time);
			$stmt->bindparam(":Author_ip",$ip);
            $stmt->bindparam(":Reply_to_id",$reply_to_id);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		

	}

} //class


?>