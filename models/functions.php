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

function get_author_by_article ($article_id) {
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT author_id FROM articles WHERE id= ?");   
    $stmt->execute([$article_id]);
    $stmt = $stmt->fetchAll();
        
    $author_id = $stmt[0]['author_id'];
    
    $stmt = $articles->runQuery("SELECT * FROM users WHERE userID= ?");
    $stmt->execute([$author_id]);
    $stmt = $stmt->fetchAll();
    
    
    return $stmt[0];
}




?>