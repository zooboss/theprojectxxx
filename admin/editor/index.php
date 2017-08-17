<?php 
if (!defined("Admin") )
{
if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;
}	
exit ("Пошел на хуй");
}
else {

if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['_SS'])) //проверяем наличие админской сессии
{
	if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;  //убиваем сессию, если нет адмиской сессии
}	
exit ("Пошел на хуй");
}
else { // если есть админская сессия и админский кукис
require_once "richtexteditor/include_rte.php" 

?>   


<div class="container">

        <form id="form1" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text="Новая статья"; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
        </form> 
		

   
	</div>



<?php }  // конец если есть админская сессия и админский кукис
} 
?>