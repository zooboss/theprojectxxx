<?php 
if (!defined("Redactor_check") or !isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session']) )
{
exit ("Пошел на хуй");	
}
else {
	
class Database
{
     
    private $host = "localhost";
    private $db_name = "blog";
    private $username = "root";
    private $password = "";
	private $charset = "UTF8";
    public $conn;
      
	  
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name .";charset=". $this->charset, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//заменить на PDO::ERRMODE_SILENT //
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
		
        }
         
        return $this->conn;
    }
	
	
	
}

class ARTICLES {	

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



//Добавление новой статьи
public function add_article($recieved_date,$article_date,$article_time,$ip_1)
{



try
		{		
			$stmt = $this->conn->prepare("INSERT INTO articles(content,date,Time,IP) 
			             VALUES(:Content,:Date,:Time,:IP)");
			$stmt->bindparam(":Content",$recieved_date);
			$stmt->bindparam(":Date",$article_date);
			$stmt->bindparam(":Time",$article_time);
			$stmt->bindparam(":IP",$ip_1);

			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		

	}
	
}



}	
	
?>	