<?php

require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 

?>

<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    <script src="/theprojectxxx/js/comments.js"></script>
</head>
<body>
   <?php 
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php");  
    ?>
   
<section class = "container-fluid article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
	
<!-- popup window sovial registration -->
	<div class="overlay" title="окно"></div> 
        <div class="popup">
        <div class="close_window">x</div>
    </div>
	

	

	
        <div class = "article">
           <div class = "article-main-image-wrap">
                <img alt="#0" src="img/test_image4.jpg" class = "img-responsive pull-left"> 
           </div>
            <div class = "article-header">
                <h1> <strong><?=$article['title']?></strong> </h1>
                <em> <?="date_icon &nbsp;" . $article['date'] . "&nbsp;" . "comment_icon 48" ?></em>
                <em class = "labels"> label_icon Хохлы, бандеры, либерахи</em>
            </div>
            
            <div class = "article-content">
                <?=$article['content']?></p>
            </div>
            
            <div class = "article-footer">
                <div class='share-social'>
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
                </div>
                

            </div>
            
        </div>
    </div>
    <div class = "col-md-3 hidden-sm hidden-xs">
        <div class = "article-related">
            <h3>news list</h3>
            <?php foreach ($articles as $a): ?>  
            <!-- отдельный блок статьи-->
        
            <div class='article-wrap' >                           
                <div class='image-wrap'> 
                    <img alt="#0" src="img/test_image4.jpg"> 
                   
                    <div class='post-author'>

                        <div class='image-thumb'>
                            <img alt='#0' title='#0' src='img/author_icon.jpg'/>
                            <cite> 
                                <a href="#0"><?php echo "Author"; ?></a> 
                                <span><?php echo "{$a['date']}"; ?> </span>
                            </cite>  
                        </div>
                    </div>
                    
                </div>
                
                <div class='post-body'>
                    <div class='post-title'>
                        <h2><a href="index.php?send=article&id=<?=$a['id']?>"> <?php echo $a['title'] ?> </a></h2> <!-- Вывод названия статьи, первые 100 символов по дефолту -->
                    </div>

                    <div class='post-entry'>
                     <p> <?php echo articles_intro($a['content']) ?></p> <!-- Вывод текста, первые 100 символов по дефолту -->
                    </div>

                    <div class='postfooter clearfix'>
                       <i class='fa fa-comment linker'></i>
                        <a class='linker' href="index.php?send=article&id=<?=$a['id']?>#comments" >48 Комментариев</a>
                        <!-- Социалки для превью статьи
                            <div class='socialpost'>
                               <div class='icons clearfix'>
                                <a href='#0'><i class='fa fa-facebook'></i><div class='texts'>Facebook</div></a>
                                <a href='#0'><i class='fa fa-vk'></i><div class='texts'>VK</div></a>
                                <a href='#0'><i class='fa fa-twitter'></i><div class='texts'>Twitter</div></a>
                                </div>
                               
                            </div>
                        --> 
                        <a href="index.php?send=article&id=<?=$a['id']?>"><div class='read'>Читать </div></a>
                    </div>
                </div>
            </div>   
        
        <!-- отдельный блок статьи-->
        <?php endforeach ?>
        </div>
    </div>
</section>

<?php
    
    
?>

<section class = "container-fluid article-comments">
    
    
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