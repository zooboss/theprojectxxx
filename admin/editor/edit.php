<?php 
if ( empty($_POST["content"]) and empty ($_POST["Editor1"])) {  //проверяем наличие нужного Post запроса
 exit ("Пошел на хуй");	
  }
else 
{  
session_start ();
if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session'])) //проверяем наличие админской сессии
{
	if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;  //убиваем сессию, если нет адмиской сессии
}	
exit ("Пошел на хуй");
}
else { // если есть админская сессия и админский кукис
  
if (isset ($_POST["Editor1"]) and !isset ($_SERVER['HTTP_X_REQUESTED_WITH'])) //Если есть запрос Post и нет никакого заголовка
{	  
	require_once "richtexteditor/include_rte.php" ;
	$data = $_POST["Editor1"];
?>  
<html>
<head>
    <?php 
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); 
    ?>
</head>
<body>   


<h3>Предпросомотр</h3>


<section class = "container-fluid container-fluid-my article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
	
	        <div class = "article">
           <div class = "article-main-image-wrap">
                <img alt="#0" src="img/test_image4.jpg" class = "img-responsive pull-left"> 
           </div>
            <div class = "article-header">
                <h1> <strong><?=$article['title']?></strong> </h1>
            </div>

			<div class = "article-content">
			<?php
			echo  $data;
			?>
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

   
</section>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>		
     
<form id="add_article" method="POST" action="edit.php">
<textarea name="content" style="display:none;"><?php echo  $data; ?></textarea>
<input type="submit" class="" name="btn-comment" value="Добавить статью"></input>
 </form>


<h2>Редактирование </h2>

      <form id="form1" method="POST" action="edit.php">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text=$data; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
 ?>   
        </form>
		


</body> 
</html>		
	<?php	
	}  //Конец если есть запрос Post и он не от Аякса

elseif  (isset($_POST["content"])  and !isset($_SERVER['HTTP_X_REQUESTED_WITH']))  //если есть контент и нет аяксса
{
define("Redactor_check", true);	
require_once "add_new_article.php" ;	
$add_article_content = new ARTICLES();
$recieved_date = $_POST["content"];
$article_date = date("Y.m.d.");  //дата
$article_time = date("H:i:s"); 
$ip = $_SERVER["REMOTE_ADDR"];
$ip_1 = ip2long($ip);
$add_article_content->add_article($recieved_date,$article_date,$article_time,$ip_1);
echo "Добавлено";
session_destroy();
}
else {
	if (isset ($_SESSION))
	{
		$_SESSION['userSession'] = false;
	}	
exit ("Пошел на хуй");	
}
} // конец если есть админская сессия и админский кукис
}


	?> 
		