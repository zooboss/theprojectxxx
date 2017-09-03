<?php

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 

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
	
	
}

function articles_all(){
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT * FROM articles ORDER BY id DESC");   
    $stmt->execute();
    $stmt = $stmt->fetchAll();
        
    return $stmt;
}

function articles_get($id_article)
{
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT * FROM articles WHERE id= ?");   
    $stmt->execute([$id_article]);
    $stmt = $stmt->fetchAll();
        
    return $stmt[0];
}

/*function articles_new($title, $date, $content){
    $title = trim($title);
    $content = trim($content);
    
    if ($title == '') return false;
    
    $query = "INSERT INTO articles (title, date, content) VALUES ('%s', '%s', '%s')";
    $query = sprintf($query, $title, mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $content));
    
    $result = mysqli_query($link, $query);
    
    if (!$result) 
        die(mysqli_error($link));
    
    return true;
}

function articles_edit($link, $id, $title, $date, $content){
    $title = trim($title);
    $content = trim($content);
    
    if ($title == '') return false;
    
    $query = "UPDATE articles SET title = '%s', date = '%s', content = '%s' WHERE id = '%d'";
    $query = sprintf($query, $title, mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $content), $id);
    
    $result = mysqli_query($link, $query);
    
    if (!$result) 
        die(mysqli_error($link));
    
    return true;
}

function articles_delete($link, $id){
    $query = "DELETE FROM articles WHERE id = %d";
    $query = sprintf($query, (int)$id);
    $result = mysqli_query($link, $query);
    
    if (!$result) 
        die(mysqli_error($link));
    return true;
} 
*/

function articles_intro($text, $len = 100)
{
    return mb_substr($text, 0, $len);   
}



function get_articles_visited (){
    if ( isset($_COOKIE['articles_visited']) and !empty($_COOKIE['articles_visited']) ){
        $articles_visited = $_COOKIE['articles_visited'];
        $articles_visited = stripslashes($articles_visited);
        $articles_visited = json_decode($articles_visited, true);
    }
    else {
        $articles_visited = array();
    }
    
    $articles_visited = array_unique($articles_visited);
    return $articles_visited;
    
}

function set_article_visited ($article_id) {
    
    if ( isset($_COOKIE['articles_visited']) and !empty($_COOKIE['articles_visited']) ){
        //get COOKIE
        $articles_visited = get_articles_visited();
        
        
        //set new COOKIE
        if (array_search($article_id, $articles_visited) == false){
            array_push($articles_visited, $article_id);
            $articles_visited = json_encode($articles_visited, true);
            setcookie('articles_visited', $articles_visited);
        }
        
        
    }
    else{
        $articles_visited = array();
        array_push($articles_visited, $article_id);
        $articles_visited = json_encode($articles_visited, true);
        setcookie('articles_visited', $articles_visited);
    }
    
}



?>