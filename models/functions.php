<?php

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/search/core.php");

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

function get_comments_number ($article_id) {
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT id FROM comments WHERE article_id= ?");
    $stmt->execute([$article_id]);
    $stmt = $stmt->fetchAll();
    
    return count($stmt);
}

function get_articles_by_cathegory ($cathegory){
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT id FROM articles WHERE tag= ?");
    $stmt->execute([$cathegory]);
    $stmt = $stmt->fetchAll();
    
    $article_ids = [];
    foreach($stmt as $s) {
        array_push($article_ids, $s['id']);
    }
    
    return $article_ids;
}

function get_all_ids () {
    $articles = new ARTICLES();
    
    $stmt = $articles->runQuery("SELECT id FROM articles");
    $stmt->execute();
    $stmt = $stmt->fetchAll();
    
    $article_ids = [];
    foreach($stmt as $s) {
        array_push($article_ids, $s['id']);
    }
    
    return $article_ids;
}

/* Search functions */

function SITE_INDEX () {
    // Индексация всех статей на сайте - инициация //
    // Заготовка в меню рейтинг личного кабинета //
    
    $SEARCH = new SEARCH();
    $ARTICLES = new ARTICLES();
    
    $stmt = $ARTICLES->runQuery("SELECT id, title, content, keywords FROM articles");
    $stmt->execute();
    $stmt = $stmt->fetchAll();
    
    foreach ($stmt as $s) {
        $author = get_author_by_article( $s[ 'id' ] )[ 'PublicUserName' ];
        $title = $s[ 'title'];
        $content = $s[ 'content' ];
        $keywords = $s [ 'keywords' ];
        
        $article_index = $SEARCH->integrated_index( $author, $title, $content, $keywords );
        $article_index = json_encode( $article_index );
        //var_dump ($article_index);
        
        try {
            $statement = $ARTICLES->runQuery("UPDATE articles SET article_index = :aindex WHERE id = :aid");
            $statement->bindparam( ":aindex", $article_index );
            $statement->bindparam( ":aid", $s[ 'id' ] );
            $statement->execute();
            
        }
        catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
        
    }

}

function SITE_SEARCH ( $search_phrase ) {
    
}
















?>