<?php

function get_my_comments ($author) {
    $author_comments = new COMMENTS();

    $stmt = $author_comments->runQuery("SELECT * FROM comments WHERE author= ?");   
    $stmt->execute([$author]);
    $stmt = $stmt->fetchAll();
    return $stmt;
}