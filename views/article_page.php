<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
</head>
<body>
   <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>
   
    <div class = "article col-md-12">
        <h3> <?=$article['title']?></h3>
                <em> Published: <?=$article['date']?></em>
                <p><?=$article['content']?></p>
    </div>
    
    
    <p><a name="comments"></a></p>
    <h1>Комментарии</h1>
    
</body>
</html>