<?php 
if (defined("Admin") or defined("Redactor_check"))
{	
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
}
else 
{
exit ('Пошел на хуй');	
}
?>