<!DOCTYPE html>

<html>
    <head>
        <?php 
        include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); 
        ?>
         <script src="/theprojectxxx/js/main_page.js"></script>
        
    </head>
    
<body>   



<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<section id = "section-search" class = "container-fluid container-fluid-my">
    <div class = "row">
        <div class = "col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
           
            <input type = "search" placeholder = "Поиск..." name = "search" class = "main-search">
                      
        </div>
    </div>
</section>	
		
<?php   if ($user_login->is_logged_in()!="" and $row['role']=="chief")
{ //если залогинен и шеф
define("Security", true);
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/admin/index.php"); //включаем первый редактор
if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['_SS'])) //проверяем наличие админской сессии
{
	if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;  //убиваем сессию, если нет адмиской сессии
}	
exit ("Пошел на хуй111");
} //конец проверяем наличие админской сессии

else { //если все ок и есть запрос от редактора в admin/index.php плдключаем редактор на текущей странице, форма редактора ссылаетсяна текущую страницы.
   if (isset($_POST["Editor1"]) and !isset ($_SERVER['HTTP_X_REQUESTED_WITH']) and defined("security"))
   {
	   require_once ($_SERVER['DOCUMENT_ROOT'] ."/theprojectxxx/admin/editor/richtexteditor/include_rte.php");
	   $data = $_POST["Editor1"];
	   require_once ($_SERVER['DOCUMENT_ROOT'] ."/theprojectxxx/admin/editor/edit.php");
	   ?>
	   <form id="form1" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text=  $data ; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
        </form> 
 <?php    
 }
  else 
 {
  //Возможно, лишнее условие
 }
 }

 
}// конец если залогинен и шеф
else {	//если не админ
?>		
    <section    id = "articlesGallery" 
                class='articlesGallery clearfix' 
                max-block-number = "<?php echo count($articles)?>"
     >

    </section>   <!-- galery -->
<?php
} // конец если не админ		
?>
<!-- BOTTOM MENU -->
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>



</body>
</html>