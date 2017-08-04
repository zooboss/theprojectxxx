<?php

function get_my_comments ($author) {
    $author_comments = new COMMENTS();

    $stmt = $author_comments->runQuery("SELECT * FROM comments WHERE author= ?");   
    $stmt->execute([$author]);
    $stmt = $stmt->fetchAll();
    return $stmt;
}

function get_article_by_id ($article_id) {
    $author_comments = new COMMENTS();

    $stmt = $author_comments->runQuery("SELECT * FROM articles WHERE id= ?");   
    $stmt->execute([$article_id]);
    $stmt = $stmt->fetchAll();
    return $stmt;
}