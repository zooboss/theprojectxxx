<?php 
session_start ();
if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session']))
{
if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;
}	
exit ("Пошел на хуй");
}
else { // если есть админская сессия и админский кукис
  
if (isset ($_POST["Editor1"]) and !isset ($_SERVER['HTTP_X_REQUESTED_WITH'])) //Если есть запрос Post и нет никакого заголовка
{	  
	require_once "richtexteditor/include_rte.php" ;
	$data = $_POST["Editor1"];
?>  
<body>   
<h3>Предпросомотр</h3>
<?php

echo  $data;
?>
<form id="add_article" method="POST" action="edit.php">
<input type="hidden" class="" name="content" value="<?php echo  $data; ?>" ></input> 
<input type="submit" class="" name="btn-comment" value="Добавить статью"></input>
 </form>

     
</body> 


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
}
else 
{	
if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;
}	
exit ("Пошел на хуй");	
}
}



	?> 
		