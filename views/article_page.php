<?php
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 

$article_comments = new COMMENTS();		


 ?>

<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
</head>
<body>
   <?php 
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php");  
    ?>
   
<section class = "container-fluid article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
	
	
	<div class="overlay" title="окно"></div> 
<div class="popup">
<div class="close_window">x</div>
</div>
	
	
	

	
        <div class = "article">
            <div class = "article-header">
                <h2> <strong><?=$article['title']?></strong> </h2>
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
        </div>
    </div>
</section>


<section class = "container-fluid article-comments">
    
    
	<div id="comments" class = "col-md-9 col-sm-12 col-xs-12">
      <p><a name="comments"></a></p>
        <h4 class = "comments-title">
            Комментарии 
            (48)
            <a href = "#0">[i]</a>

        </h4>
       <?php   
        $article_comments = new COMMENTS();	

        if($article_comments->check_comments()== true)  // проверяем есть ли коментарии при помощи функции в comments.php
        {
            $stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");
            $stmt->execute([$_GET['id']]);

            if($user_login->is_logged_in()) 
            {  //Если авторизован

                include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comment_form.php");  //выдаем форму

                } // конец если авторизован и комментарии есть

            else   //если не авторизован и комментарии есть
            {
            ?>	

                <a class="add_comment" article="<?php echo $_GET['id']; ?>" >Вскукарекнуть</a>  <!-- Всплывающее окно с социальными сетями !-->

        <?php	
        }  // конец если не авторизован и комментарии есть
        ?>
       
       
       
       
       
       
        <?php	 foreach ($stmt as $com)   //выводим комментарии в обоих случаях
        {
            ?>
		    <div class = "single-comment">
               <div class = "single-comment-avatar">
                   <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "single-comment-avatar-image">
               </div>
               <div class = "single-comment-body">
                   <div class = "single-comment-header">
                       <a href = "#0"><?php echo $com['author']?></a>
                       <span><?php echo $com['date'] . " " . $com['time'] ?></span>
                   </div>
                   <div class = "single-comment-text">
                      <span><?php echo $com['content']; ?></span>  
                   </div>
                   <div class = "single-comment-footer">
                       <a href = "#0">Ответить</a>
                   </div>                
                </div>
                
            </div>
			
           <?php
        }
        ?>		
    </div>		


    <?php
    }  // конец если есть комментарии	
  
    else  //если комментов нет 
    {
        ?>
        <div id="comments">	
        <h2>Комментариев еще нет!</h2>
        </div>
      
        <?php 
        if($user_login->is_logged_in()) {  //Если авторизован и комментариев нет

            include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comment_form.php");  //добовляем форму
        }  //конец Если авторизован и комментариев нет
        else //если не авторизован и комментарии есть
        {
        ?>	

            <div id="comments">
            <a class="add_comment" article="<?php echo $_GET['id']; ?>" >Вскукарекнуть</a>
            <h2>Авторизуйся и устрой набег!</h2>
            </div>	

        <?php 
        } //конец else если не авторизован и комментарии есть

    } 
// конец else если комментариев нет
?> 
    
</section>   


 
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>    

   
 


</body>
</html>