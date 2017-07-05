<!DOCTYPE HMTL>
<html>
<head>
    <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
</head>
<body>
   <?php 
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); 
    require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php"); 
    ?>
   
<section class = "container-fluid article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
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
                        <script type="text/javascript">
                            document.write(VK.Share.button(false,{type: "round", text: "&nbsp;"}));
                        </script>
                    </div>
                    <div class = "ok-share">
                        <div id="ok_shareWidget"></div>
                        <script>
                            !function (d, id, did, st, title, description, image) {
                              var js = d.createElement("script");
                              js.src = "https://connect.ok.ru/connect.js";
                              js.onload = js.onreadystatechange = function () {
                              if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                                if (!this.executed) {
                                  this.executed = true;
                                  setTimeout(function () {
                                    OK.CONNECT.insertShareWidget(id,did,st, title, description, image);
                                  }, 0);
                                }
                              }};
                              d.documentElement.appendChild(js);
                            }(document,"ok_shareWidget",document.URL,'{"sz":20,"st":"straight","nt":1}',"","","");
                        </script>
                    </div>
                    <div class = "fb-share">
                        <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.9";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
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
    <p><a name="comments"></a></p>
    <h4 class = "comments-title">
        Комментарии 
        (48)
        <a href = "#0">[i]</a>
    </h4>
    
    <form class = "comment-form" method = "post">
        <fieldset>
            <input class="user" type="textarea"  id="comment-textarea" name="comment" required>
        </fieldset> 
        <input type="submit" name="btn-signup" value="Отправить" id="submit" class="btnDisabled" disabled>
                        
    </form>
         
    <?php   
    $article_comments = new COMMENTS();	

    if($article_comments->check_comments()== true)  // проверяем есть ли коментарии при помощи функции в comments.php
    {
        $stmt = $article_comments->runQuery("SELECT * FROM comments WHERE article_id= ?");
        $stmt->execute([$_GET['id']]);
                                                    // Вывод комментариев
        foreach ($stmt as $row)
        {
            ?>
            <p>Автор:<?php echo $row['author']; ?> </p>
            <p>Комментарий:<?php echo $row['content']; ?> </p> 
            <p>Дата:<?php echo $row['date']; ?> </p> 
            <p>Дата:<?php echo $row['time']; ?> </p> 
           <?php
        }
    }
    else  //если комментов нет 
    {
    ?>  
    <h2>Комментариев еще нет!</h2>
    <button>Стать першим на хохлосраче</button>
    <?php 
    }
    ?> 
    
</section>   
    
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>    

   
  


</body>
</html>