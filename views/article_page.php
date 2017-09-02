<?php

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/functions.php"); 



?>

<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    <script src="/theprojectxxx/js/comments.js"></script>
</head>
<body class = "article-page-body">
   <?php 
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php");  
    ?>
   
<section class = "container-fluid container-fluid-my article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
	
<!-- popup window social registration -->
	<div class="overlay" title="окно"></div> 
        <div class="popup">
        <div class="close_window">x</div>
    </div>
	

	

	
        <div class = "article">
           <h1> <strong><?=$article['title']?></strong> </h1>
           <div class = "article-main-image-wrap">
                <img alt="<?=$article['img_main_alt']?>" src="img/articles/article_image-<?=$article['id']?>.jpg" class = "img-responsive pull-left"> 
           </div>
            <div class = "article-header">
               
                <!--
                <em> <?="date_icon &nbsp;" . $article['date'] . "&nbsp;" . "comment_icon 48" ?></em>
                <em class = "labels"> <?php echo $article['tag'] ?></em>
                -->
            </div>
            
            <div class = "article-content">
                <?=$article['content']?></p>
            </div>
            
            <div class = "article-footer">
               
                <div class='share-social'>
                   <!--
                    <div class = "vk-share">
                        <script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
                    
                    </div>
                    <div class = "ok-share">
                        <div id="ok_shareWidget"></div>
  
                    </div>
                    <div class = "fb-share">
                        <div id="fb-root"></div>
                 
                            <div class="fb-share-button" data-href="localhost/theprojectxxx/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">&nbsp;</a></div>
                    </div>
                    <div class = "tw-share">
                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                -->
                </div>
                

            </div>
            
        </div>
    </div>
    <div class = "col-md-3 hidden-sm hidden-xs">
        <h3 class = "last-related-articles text-right">ПОСЛЕДНИЕ СТАТЬИ</h3>
        <div class = "article-related">
            <!--<h3>Последние статьи</h3>-->
            <?php 
                    
                for ( ($key = 1 ); ($key <  7 ); $key++ ) { 
                    $a = $articles[ $key ];
                    
                    $article_author = get_author_by_article($a['id']);
                    $comments_number = get_comments_number($a['id']);
                    $comments_number_noun = "комментариев";
                    $article_date = $a['date'];
                    $article_date_array = explode("-", $article_date);
                    $article_date_array_numeric = $article_date_array;
                    switch (substr($comments_number, -1)){
                        case "1":
                        $comments_number_noun = "комментарий";
                        break;
                        case "2":
                        $comments_number_noun = "комментария";
                        break;
                        case "3":
                        $comments_number_noun = "комментария";
                        break; 
                        case "4":
                        $comments_number_noun = "комментария";
                        break;    
                    }
                ?>  
            <!-- отдельный блок статьи-->
        
            <div class='article-wrap' >                           
                              
                <div class='post-body post-body-related'>
                    <div class='post-title'>
                        <h2 class = "post-related-title"><a href="index.php?send=article&id=<?=$a['id']?>"> <?php echo $a['title'] ?> </a></h2> <!-- Вывод названия статьи, первые 100 символов по дефолту -->
                        <h4>
                            <img class = "related-author-image" alt='#0' title='#0' src='img/avatars/user-<?php echo $article_author['userID'] ?>.jpg'/>   
                            <a class = "main-page-author-name" href="http://localhost/theprojectxxx/user-<?php echo $article_author['userID'] ?>.html">
                                <span class = "related-author-name">
                                    <?php echo $article_author['PublicUserName'] . ", " ?>
                                </span>
                                <span class = "related-author-date">   
                                    <?php echo $article_date_array_numeric[2] . "." . $article_date_array_numeric[1] . "." . $article_date_array_numeric[0] ?>
                                </span>
                            </a>
                        </h4>
                    </div>

                    <div class='post-entry'>
                     <p class = "post-related-content"> <?php echo articles_intro($a['content']) ?></p> <!-- Вывод текста, первые 100 символов по дефолту -->
                    </div>

                    <div class='postfooter clearfix'>
                       <i class='fa fa-comment linker'></i>
                        <a class='linker' href="index.php?send=article&id=<?=$a['id']?>#comments" ><?php echo $comments_number . " " . $comments_number_noun ?></a>
                        <!-- Социалки для превью статьи
                            <div class='socialpost'>
                               <div class='icons clearfix'>
                                <a href='#0'><i class='fa fa-facebook'></i><div class='texts'>Facebook</div></a>
                                <a href='#0'><i class='fa fa-vk'></i><div class='texts'>VK</div></a>
                                <a href='#0'><i class='fa fa-twitter'></i><div class='texts'>Twitter</div></a>
                                </div>
                               
                            </div>
                        --> 
                        <!--<a href="index.php?send=article&id=<?=$a['id']?>"><div class='read'>Читать </div></a>-->
                    </div>
                </div>
            </div>   
        
        <!-- отдельный блок статьи-->
        <?php } ?>
        </div>
    </div>
</section>

<?php
    
    
?>

<section class = "container-fluid container-fluid-my article-comments">
    
    
	<div id="comments" class = "col-md-9 col-sm-12 col-xs-12" 
             index = "<?=$_GET['id']?>" 
             user_logged = "<?php echo $user_login->is_logged_in() ?>" 
             public_user_name = "<?php echo $row['PublicUserName']  ?>"
    >
      		
    </div>		
    
</section>   


 
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>


   
 


</body>
</html>