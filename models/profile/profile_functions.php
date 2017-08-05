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
        array_push($author_replies, $stmt);
    }
    return $author_replies;
}





















