<?php

function get_my_comments ($author) {
    $author_comments = new COMMENTS();

    $stmt = $author_comments->runQuery("SELECT * FROM comments WHERE author= ?");   
    $stmt->execute([$author]);
    $stmt = $stmt->fetchAll();
    $stmt = array_reverse($stmt);
    return $stmt;
}

function get_article_by_id ($article_id) {
    $author_comments = new COMMENTS();

    $stmt = $author_comments->runQuery("SELECT * FROM articles WHERE id= ?");   
    $stmt->execute([$article_id]);
    $stmt = $stmt->fetchAll();
    return $stmt;
}

function get_my_replies ($author) {
    $search_replies = new COMMENTS();
    
    $author_comments = get_my_comments($author);
    $author_replies = [];
    
    foreach ($author_comments as $comment) {
        $stmt = $search_replies->runQuery("SELECT * FROM comments WHERE reply_to_id= ?");
        $stmt->execute([$comment['id']]);
        $stmt = $stmt->fetchAll();
        foreach($stmt as $key) {
            if ($key['author'] != $author){
                array_push($author_replies, $stmt);    
            }
               
        }
        
    }
    
    //Сортировка массива по id
    
    usort ($author_replies, function ($a, $b) {
       return $a[0]['id'] - $b[0]['id']; 
    });
    
    return $author_replies;
}


function get_not_visited_articles ($articles_visited){
    $search_not_visited = new ARTICLES();
    
    $stmt = $search_not_visited->runQuery("SELECT * FROM articles ");   
    $stmt->execute();
    $stmt = $stmt->fetchAll();
    
    $all_IDs = array();
    foreach ($stmt as $article){
        array_push($all_IDs, $article['id']);
    }
    
    $uniq_IDs = array_diff($all_IDs, $articles_visited);
    
    return $uniq_IDs;
}


















