<?php

function articles_all($link){
    $query = "SELECT * FROM articles ORDER BY id DESC";
    $result = $link->query($query, MYSQLI_STORE_RESULT);
    
    if(!$result)
        die(mysqli_error($link));
    
    $articles = array();
    while ($row = $result->fetch_array(MYSQLI_BOTH))
    {
        $articles[] = $row;
    }
    
    return $articles;
}

function articles_get($link, $id_article)
{
    $query = sprintf("SELECT * FROM articles WHERE id=%d", (int)$id_article);
    $result = $link->query($query, MYSQLI_STORE_RESULT);
    
    if (!$result)
        die(mysqli_error($link));
    
    $article = $result->fetch_array(MYSQLI_BOTH);
    
    return $article;
}

function articles_new($link, $title, $date, $content){
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

function articles_intro($text, $len = 100)
{
    return mb_substr($text, 0, $len);   
}






?>